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
        $this->viewPath = dirname(__FILE__);
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
     */
    public function setData($data) {
        $this->data = $data;
    }

    /**获取挂件渲染后的HTML代码
     * @return string
     */
    public function getRenderStr() {
        ob_start();
        $this->render();
        return ob_get_clean();
    }
}