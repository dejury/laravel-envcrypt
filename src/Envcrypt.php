<?php

namespace Dejury\Envcrypt;

use Illuminate\Encryption\Encrypter;
use Illuminate\Support\Str;

class Envcrypt
{

    /**
     * @var Encrypter
     */
    protected $encrypter;

    /**
     * @var string $env
     */
    protected $env;

    /**
     * @var array $decrypted ;
     */
    protected $decrypted;

    /**
     * @var array $fileContents
     */
    protected $fileContents;

    /**
     * Envcrypt constructor.
     *
     * @param  Encrypter  $encrypt
     */
    public function __construct(Encrypter $encrypt)
    {
        $this->encrypter = $encrypt;
        $this->setEnv(config('app.env'));
    }

    /**
     * @param  string  $env
     * @return Envcrypt
     */
    public function setEnv(string $env): self
    {
        $this->env = $env;
        return $this;
    }

    /**
     * Will load all encrypted
     * vars of the current environment
     * into the env() functionality of Laravel
     */
    public function init()
    {
        $vars = $this->load()->all();
        foreach ($vars as $key => $value) {
            putenv($key.'="'.$value.'"');
        }
    }

    /**
     * Get the location of the encrypted file
     *
     * @return string
     */
    public function getFilePathToEncryptedFile()
    {
        return config('envcrypt.location').'/.env.enc.'.Str::slug($this->env);
    }

    /**
     * Get the decrypted contents of the current file
     *
     * @return Envcrypt
     */
    public function load(): self
    {
        $path = $this->getFilePathToEncryptedFile();

        if (!file_exists($path)) {
            $this->decrypted[$this->env] = [];
            return $this;
        }

        $this->fileContents[$this->env] = $this->encrypter->decrypt(file_get_contents($path));
        $this->decrypted[$this->env] = json_decode($this->fileContents[$this->env], true);
        return $this;
    }

    /**
     * Get the plain content of the file
     *
     * @return string
     */
    public function content(): string
    {
        return $this->fileContents[$this->env];
    }

    /**
     * Get the decrypted array
     *
     * @return array
     */
    public function all(): array
    {
        return $this->decrypted[$this->env] ?? [];
    }

    /**
     * Get an key
     *
     * @param $key
     * @return mixed|null
     */
    public function get($key)
    {
        return $this->all()[$key] ?? null;
    }

    /**
     * Set / Edit an key
     *
     * @param $key
     * @param  null  $value
     * @return $this
     */
    public function set($key, $value = null): self
    {
        $this->decrypted [$this->env][$key] = $value;
        return $this;
    }

    /**
     * Remove a key from the encrypted file
     *
     * @param $key
     * @return $this
     */
    public function remove($key): self
    {
        if (isset($this->decrypted[$this->env][$key])) {
            unset($this->decrypted[$this->env][$key]);
        }
        return $this;
    }

    /**
     * Store the plain text encrypted
     *
     * @return Envcrypt
     */
    public function store(): self
    {
        $this->fileContents[$this->env] = json_encode($this->all(), JSON_PRETTY_PRINT);
        $encrypted = $this->encrypter->encrypt($this->fileContents[$this->env]);

        file_put_contents($this->getFilePathToEncryptedFile(), $encrypted);

        return $this;
    }


}
