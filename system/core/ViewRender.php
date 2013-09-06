<?php
/**
 * 视图加载和渲染类
 * @author: sugan
 * @date: 2013-9-5
 */
abstract class ViewRender {

    //输出到页面的HTML代码缓存
    protected $output;

    //view文件根目录
    protected $viewPath;

    //变量缓存，为了在多个view之间共用变量名
    //若变量名一样，后一个变量会覆盖前一个变量的值
    protected $cacheVars = array();

    //视图挂件数据组
    protected $widgets = array();

    /**加载view文件变缓存变量函数
     * @param $view  app/view目录下的文件路径
     * @param array $vars   传给view的变量数组
     * @param bool $return
     * @return string
     * @throws InvalidArgumentException
     */
    public function view($view, $vars = array(), $return = FALSE) {

        $_ext = pathinfo($view, PATHINFO_EXTENSION);
        $_file = ($_ext == '') ? $view . '.php' : $view;

        $path = $this->viewPath . "/{$_file}";
        if (!file_exists($path)) throw new InvalidArgumentException('no such file : ' . $path);

        if (!empty($this->cacheVars) && !empty($vars))
            $this->cacheVars = array_merge($this->cacheVars, $vars);

        extract($this->cacheVars);

        ob_start();

        if ((bool)@ini_get('short_open_tag') === FALSE) {
            echo eval('?>' . preg_replace("/;*\s*\?>/", "; ?>", str_replace('<?=', '<?php echo ', file_get_contents($path))));
        } else {
            include $path;
        }

        if ($return) {
            return ob_get_clean();
        }

        $this->output .= ob_get_contents();
        ob_end_clean();
    }

    /**添加挂件
     * @param Widget $widget
     * @return $this
     */
    public function addWidget(Widget $widget) {
        $id = $widget->id();
        $this->widgets[$id] = $widget;
    }


    public function display() {
        if (!empty($this->widgets)) {

            foreach ($this->widgets as $w) {
                $id = $w->id();
                $class = get_class($w);
                $widgetTag = "<{$class}>{$id}</{$class}>";

                $this->output = str_replace($widgetTag, $w->getRenderStr(), $this->output);
            }

        }
        echo $this->output;
    }

}
