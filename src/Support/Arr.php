<?php
/**
 * Created by spiderX.
 * @File: Arr.php
 * @User: Hui
 * @Author: learner.hui@gmail.com
 * @Date: 2018/11/19
 * @Time: 10:31
 */

namespace Spider\Support;


class Arr implements \ArrayAccess
{
    protected $arr;

    public function get($key, $default = null)
    {
        $config = $this->arr;
        if(is_null($key)) {
            return null;
        }

        if(isset($config[$key])) {
            return $config[$key];
        }

        if(false === strpos($key, '.')) {
            return $default;
        }

        foreach (explode('.', $key) as $segment) {
            if(!is_array($config) || !array_key_exists($segment, $config)) {
                return $default;
            }
            $config = $config[$segment];
        }
        return $config;
    }

    public function offsetExists($offset)
    {
        return array_key_exists($offset, $this->arr);
    }

    public function offsetGet($offset)
    {
        return $this->get($offset);
    }

    public function offsetSet($offset, $value)
    {
        if(isset($this->arr[$offset])) {
            $this->arr[$offset] = $value;
        }
    }

    public function offsetUnset($offset)
    {
        if(isset($this->arr[$offset])) {
            unset($this->arr[$offset]);
        }
    }
}