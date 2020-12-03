<?php
/**
 * Created by Idea.
 * User: wayee
 * Date: 2020/12/3
 * Time: 下午10:35
 */

namespace App\Layout;

class Column
{
    protected $content = '';

    protected $class = [];

    protected $width = 0;


    /**
     * Column constructor.
     * @param string $content
     */
    public function __construct(string $content = '')
    {
        $this->content = $content;
    }

    /**
     * @param mixed ...$params
     *
     * @return static
     */
    public static function make(...$params)
    {
        return new static(...$params);
    }

    /**
     * @param int $width
     * @return $this
     */
    public function width($width = 0)
    {
        $this->width = $width;
        return $this;
    }

    /**
     * @param string|array $class
     * @return $this
     */
    public function class($class = [])
    {
        if (is_array($class)) {
            $this->class = array_merge($class, $this->class);
        } else {
            $this->class[] = $class;
        }
        return $this;
    }

    /**
     * @param $content
     * @param string $class
     * @return $this
     */
    public function label($content, $class = 'default')
    {
        $this->content .= sprintf(' <span class="label bg-%s">%s</span>', $class, $content);
        return $this;
    }

    /**
     * @return string
     */
    public function content()
    {
        return $this->content;
    }

    /**
     * @return string
     */
    public function attributes()
    {
        $attributes = '';

        if (empty($this->class)) {
            $attributes .= sprintf('class="%s" ', implode(' ', $this->class));
        }
        if ($this->width) {
            $attributes .= sprintf('width="%s" ', $this->width);
        }

        return $attributes;
    }
}
