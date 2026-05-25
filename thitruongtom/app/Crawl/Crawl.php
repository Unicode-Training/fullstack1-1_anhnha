<?php 
namespace App\Crawl;
use Facebook\WebDriver\Chrome\ChromeOptions;
use Facebook\WebDriver\Remote\DesiredCapabilities;
use Facebook\WebDriver\Remote\RemoteWebDriver;
use Laravel\Dusk\Browser;
use Laravel\Dusk\Concerns\ProvidesBrowser;
use Symfony\Component\DomCrawler\Crawler;


class Crawl {
    use ProvidesBrowser;
    public function handle() {
        // static::startClass();

        $this->browse(function (Browser $browser) {
            $username = 'sam2909';
            $password = '0936121030';
            $tokenFile = storage_path('app/saved_token.txt');
            $url = "https://www.thitruongtom.com/post/574012/toan-canh-thi-truong-tom-ngay-21-5-2026-luong-thu-mua-tom-the-nguyen-lieu-cua-cac-nha-may-lon-tai-dbscl-it-bien-dong-so-voi-hom-qua";
            $browser->visit($url);
            
            if (file_exists($tokenFile)) {
                $savedToken = file_get_contents($tokenFile);
                 $browser->script([
                "localStorage.setItem('vss-auth', '{$savedToken}');",
                ]);
                $browser->refresh()->pause(1000); 
            }
            if ($browser->element('.access-denined')) {
                $browser->visit('https://www.thitruongtom.com/login');
                $browser->type('[name="username"]', $username);
                $browser->type('[name="password"]', $password);
                $browser->click('.ant-btn');
                $browser->pause(1000);
                $newToken = $browser->script("return localStorage.getItem('vss-auth');");
                if ($newToken) {
                    file_put_contents($tokenFile, $newToken);
                    $browser->visit($url);
                    if (file_exists($tokenFile)) {
                        $savedToken = file_get_contents($tokenFile);
                        $browser->script([
                        "localStorage.setItem('vss-auth', '{$savedToken}');",
                        ]);
                        $browser->refresh()->pause(1000); 
                    }
                }
            } else if ($browser->element('.form-login')) {
                 $browser->type('[name="username"]', $username);
                $browser->type('[name="password"]', $password);
                $browser->click('.ant-btn');
                $browser->pause(1000);
                $newToken = $browser->script("return localStorage.getItem('vss-auth');");
                if ($newToken) {
                    file_put_contents($tokenFile, $newToken);
                    $browser->visit($url);
                    if (file_exists($tokenFile)) {
                        $savedToken = file_get_contents($tokenFile);
                        $browser->script([
                        "localStorage.setItem('vss-auth', '{$savedToken}');",
                        ]);
                        $browser->refresh()->pause(1000); 
                    }
                }
            }
            $html = $browser->driver->getPageSource();
            $crawler = new Crawler($html);
            $title = $crawler->filter('.Wrapper__ContentTitle-fih67w-1')->text();
            $content = $crawler->filter('[style="position: relative; display: block; overflow: hidden; width: 100%; height: auto;"]')->html();
            $contentArr = explode("\n", $content);
            array_pop($contentArr);
            $content = implode("\n", $contentArr);
            preg_match_all("~.+?AgroMonitor.+~", $content, $matches);
            if (!empty($matches[0])) {
               foreach ( $matches[0] as $item) {
                $content = str_replace($item, '', $content);
               }
            }
            // echo $title;
            echo $content;
            exit;
            // echo $html;
       });
    //    static::stopClass();
    }

    protected function driver()
    {
        $capabilities = DesiredCapabilities::chrome();
        
        $options = new ChromeOptions();
       
        $options->addArguments([
            '--headless',
            '--disable-gpu',
            '--no-sandbox',
            '--ignore-certificate-errors'
        ]);
        
        $capabilities->setCapability(ChromeOptions::CAPABILITY, $options);

        return RemoteWebDriver::create('http://127.0.0.1:59555', $capabilities);
    }
}