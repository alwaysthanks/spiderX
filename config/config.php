<?php
/**
 * Created by spiderX.
 * @File: config.php
 * @User: Hui
 * @Author: learner.hui@gmail.com
 * @Date: 2018/11/15
 * @Time: 14:58
 */

return [

   /*
   |--------------------------------------------------------------------------
   | SpiderX Default Config
   |--------------------------------------------------------------------------
   */

   // Request Config
   'request' => [

       /**
        * request parameter
        *
        */
       'query'  => [

       ],

       /**
        * default headers
        *
        */
       'headers'  => [
           // default request headers
       ],

       //   . . .

   ],

   'parse' => [

       /**
        * @param \Spider\Contracts\ParseInterface
        *
        * @default \Spider\Work\Parse
        *
        */
       'parse' => Spider\Work\Parse::class,

       /**
        * @param \Spider\Contracts\MediaInterface
        *
        * @default \Spider\Work\Media
        *
        */
       'media' => Spider\Work\Media::class,

       /**
        * (Bytes) out range can’t be download
        * @default 4MB
        *
        **/
       'max_size'  => 1<<22,

   ],

    /**
     * Default save path
     *
     **/
    'path'  => './images/',

];