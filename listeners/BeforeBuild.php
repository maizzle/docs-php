<?php

namespace App\Listeners;

use Mni\FrontYAML\Parser;
use TightenCo\Jigsaw\Jigsaw;
use App\Listeners\ParsedownParser;

class BeforeBuild
{
    protected $jigsaw;

    public function handle(Jigsaw $jigsaw)
    {
        $this->jigsaw = $jigsaw;

        $this->setLatestReleaseInConfig();
    }

    public function setLatestReleaseInConfig()
    {
        if ($this->jigsaw->getEnvironment() == 'production')
        {
            $this->jigsaw->setConfig('collections.docs.version', $this->getLatestRelease()->tag_name);
        }
    }

    public function getLatestRelease()
    {
        $c = curl_init();
        curl_setopt( $c, CURLOPT_SSL_VERIFYPEER, false );
        curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($c, CURLOPT_USERAGENT, 'Maizzle');
        curl_setopt($c, CURLOPT_URL, 'https://api.github.com/repos/maizzle/maizzle-php/releases/latest');
        $output = curl_exec($c);
        curl_close($c);
        $release = json_decode(trim($output));
        return $release;
    }
}
