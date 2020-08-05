<?php

namespace Dejury\Envcrypt\Tests;

use Dejury\Envcrypt\Envcrypt;
use Dejury\Envcrypt\EnvcryptServiceProvider;
use Illuminate\Encryption\Encrypter;
use Orchestra\Testbench\TestCase;

class EnvcryptTest extends TestCase
{

    protected $_file = '';

    protected function getEnvironmentSetUp($app)
    {
        parent::getEnvironmentSetUp($app);

        $app['config']->set('envcrypt.key', Encrypter::generateKey('AES-256-CBC'));
        $app['config']->set('envcrypt.location', realpath(dirname(__DIR__)));
    }

    /**
     * @param  \Illuminate\Foundation\Application  $app
     * @return array|string[]
     */
    protected function getPackageProviders($app)
    {
        return [EnvcryptServiceProvider::class];
    }

    /** @test */
    public function get_set_and_check()
    {
        $tests = [
            'test1'         => 'Testing_1_2_3',
            'test2'         => ')9$j)-2KZ>LX}Lj>CS3}!NE?',
            'test3'         => '@%?xuumcPmSvHESNfSs8*8qb9Ey#P%P2_kBddf9Qs2af^ZYsbPkyNeS5p5@jqU^_rPG*KSzJF$4ppJKD#Z%D$tY&v=^3qHV3LEe_sEpnXNuM&Whzk=*$x=Upy3+dmbPMdE8a6X9NkBF?!vU4zr?JGg8DHjrGUv&=NUKjx^vn@Hg^5jh%C*S6Sy8TM&zQ?FmTY7!Mp-KxXr3Jmz7F@$D4YvshFZP_spe_WM+gZZ_cUTWGP@-!ByJ#hEKC4B=@^EK@js@D7A3%Y9Yk4b%Tpmn7xbzwSC#YL9crWKvkVZEZ#T6Y#tN%khNb+Ltb3PEK@UY5LudcU8#7N7YYqVkG4qtdxN*Atw2GhF$M2ES_E&Tj3S3tXpj3YJqu#p5BjU?yK-wgurvwcaGNd9CpamNY5kujXdvYmPUNZGM-8TtXjjeD_^ET4XpBuFkRr@Ghwuq^Uv*9%zPzkEfYZN4&rznPFZGuGrAL#gXXauV%__t5qV5Ue6dzaxjH@Pm@L^raJzyn4?$7pGvPMM^XgV*pP_ZyeJB7ycS!kpWxPwAg^n!d&DY8KEsJJ4Z6__9*qAfZSvbxRvu%8_VjUkdhAvLf5%E3cnAjm&yEX@CCjPD3rz7wu^SVKENk?anVpy$-K=p=Pzw?sh3-yHY@$7^2g9GwSh!?j6bVh7RNxVjny^Sxcs!@hQmKZ6q^3!aBWSrKB?Q++sM?Z_M2M_RWAgFmzuzaXpcu379UBCnS^Tt2g7jCH+eth_rFESACuf^xdGM6Zcv6R2MmDvrLt*@$C$nvdx^W2H8&_=LP@-U@tA&NtrgELYyB5N4Pm=spG--4JvXHyfULX3ZJM??DYUnQf!Fa5gfXS9J9WaHb+erPTETdEs&k2q?ra-BW9skU_+7=4u@+=sG9+c6TGU&%QXLL#Pd6^gX8Tgw2jPJU=CyMf$_FUtnM@g@!k&*Sj7V-73fT9m!vcctNE%e68r-W9fkcQVzZNn95tkFpLF*Xk&$k6uv%*WA-t=G^yxJ2jApKQ?LY?7a2MEk!_MU**CQA',
            'test4'         => 'This our gorgeous application',
            'test_1'        => 'Should be test_1',
            'test_2'        => null,
            'test_3'        => true,
            'test_4'        => false,
            'test_5'        => 1.05,
            'test_6'        => 60,
            'spaces in key' => 'spaces in key',

        ];


        $envcrypt = app(Envcrypt::class)->setEnv('testing');
        $this->_file = $envcrypt->getFilePathToEncryptedFile();
        foreach ($tests as $key => $value) {
            $envcrypt->set($key, $value);
        }

        $envcrypt->store();

        $this->assertEquals(json_encode($tests, JSON_PRETTY_PRINT), $envcrypt->content());
        $this->assertEquals($tests, $envcrypt->load()->all());

        $envcrypt->init();

        foreach ($tests as $key => $value) {
            $this->assertEquals($value, env($key), "$key = $value; was: ".env($key));
        }


    }

    protected function tearDown(): void
    {
        parent::tearDown();
        unlink($this->_file);
    }
}
