<?php if (!empty($list)): ?>
    <div class="com-list">
        <div id="placeholder"></div>
        <?php foreach ($list as $one): ?>
            <div class="com-li">
                <a class="com-li-l" href="javascript:void(0)">
                    <img src="static/images/user_pic.jpg" width="51" height="51" alt="头像">
                </a>

                <div class="com-li-r">
                    <div class="com-li-top">
                        <span class="c-t-l">
                        <a data-id="<?= $one['id'] ?>" class="msg_del"><em>删除</em></a></span>
                        <span class="c-t-r"><span><?=$one['ut']?></span> 发表</span></div>
                    <div class="com-text"><p class="toEdit"><?=$one['content']?></p>
                        <textarea data-id="<?= $one['id'] ?>" class="editable"
                                  style="display:none;margin: 0px; height: 75px; width: 885px;"></textarea>
                    </div>
                </div>
            </div>

        <?php endforeach; ?>
    </div>
<?php else :echo "No data"; ?>
<?php endif ?>