<?php

namespace App\Service;

use App\Entity\Helper\FibonacciHelper;
use App\Entity\Helper\FormHelper;
use SS\TwitterBundle\Api\TwitterApi;
use ICNDb;

class TableMaker
{
    //TODO: $container params probléma feloldása
    private $consumerKey = '9vjFUdYlr6YPYQ98aHNYqdJ3N';
    private $consumerSecret = 'O9Iz7WsU7fzinFTX7XBHtbj8HVFTIUTG2AAc9lf2klI23wCo96';


    public function createTable(FormHelper $helper)
    {
        if (isset($helper) && !empty($helper)) {
            $tweets = array();
            if ($helper->getHandle1()) {
                $tweets = array_merge($tweets, $this->getTwitterUserTimeLine($helper->getHandle1()));
            }
            if ($helper->getHandle2()) {
                $tweets = array_merge($tweets, $this->getTwitterUserTimeLine($helper->getHandle2()));
            }
            if (!empty($tweets)) {
                $tweets = $this->TweetSorterDesc($tweets);
                $tweets = $this->insertChuckNorris($tweets, $helper->getMethod());
            }
            //dump($tweets);
            return $tweets;
        }

    }

    private function getTwitterUserTimeLine($user, $count = 20)
    {
        $twitter = new TwitterApi($this->consumerKey, $this->consumerSecret);
        $args = $twitter->getUserTimeLine($user, $count);

        $ret = array();
        foreach ($args as $arg) {
            $ret[] = [
                'source' => 'twitter/' . $user,
                'time' => $arg->created_at,
                'message' => $arg->text,
            ];
        }
        return $ret;
    }

    private function TweetSorterDesc($tweets)
    {
        if (isset($tweets) && !empty($tweets)) {
            usort($tweets, function ($a, $b) {
                $aval = strtotime($a['time']);
                $bval = strtotime($b['time']);
                if ($aval == $bval) {
                    return 0;
                }
                return $aval < $bval ? 1 : -1;
            });
        }
        return $tweets;
    }

    private function insertChuckNorris($tweets, $method = 'fib')
    {
        $jokes = $this->getChuckNorrises(20);

        if ($method == 'fib') {
            $current = 0;
            $jokeId = 0;
            $fib = new FibonacciHelper();

            foreach ($tweets as $tweet) {
                if ($fib->isFibonacciNumber($current)) {
                    if ($jokeId >= count($jokes)) {
                        $this->getChuckNorrises(20);
                        $jokeId = 0;
                    }
                    array_splice($tweets, $current - 1, 0, array($jokes[$jokeId]));
                    $jokeId++;
                }
                $current++;
            }
        } else if ($method == 'mod') {
            $current = 0;
            $next = 2;
            $jokeId = 0;

            foreach ($tweets as $tweet) {
                if ($current == $next) {
                    if ($jokeId >= count($jokes)) {
                        $this->getChuckNorrises(20);
                        $jokeId = 0;
                    }
                    array_splice($tweets, $current, 0, array($jokes[$jokeId]));
                    $next = $next + 3;
                    $jokeId++;
                }
                $current++;
            }


        }
        return $tweets;

    }

    private function getChuckNorrises($count)
    {
        $chuck = new ICNDb\Client();
        $args = $chuck->random($count)->exclude('nerdy')->get();

        $ret = array();
        foreach ($args as $arg) {
            $ret[] = [
                'source' => 'icndb',
                'time' => '',
                'message' => $arg->joke,
            ];
        }
        return $ret;
    }
}