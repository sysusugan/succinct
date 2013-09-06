<?php
/**
 * 视图挂件类
 * @author: sugan
 * @date: 2013-9-5
 */

abstract class Widget extends ViewRender {

    //存储的数据
    protected $data;

    //挂件id
    protected $id;

    public function __construct($id) {

        if (empty($id)) throw new InvalidArgumentException('widget id should not be empty!');

        $this->id = $id;
        $this->viewPath = APP_PATH . '/widgets/' . current(explode('_', get_class($this)));
    }

    /**挂件渲染函数
     * @return mixed
     */
    public abstract function render();

    /**返回widget id
     * @return mixed
     */
    public function id() {
        return $this->id;
    }

    /**设置数据
     * @param $data
     * @return $this
     */
    public function setData($data) {
        $this->data = $data;
        return $this;
    }

    /**获取挂件渲染后的HTML代码
     * @throws InvalidArgumentException
     * @return string
     */
    public function getRenderStr() {
        //采用renderView方式
        if (!empty($this->output)) {
            $out = $this->output;
        } //采用echo或其他输出HTML代码的方式

        if (!empty($this->data)) {
            ob_start();
            $this->render();
            $out = ob_get_contents();
            ob_clean();
        }
//        var_dump($out);
        if (!empty($out)) return $out;

        throw new InvalidArgumentException('widget data must be set!');
    }
}