<div class="well" id="comment-form-container">
    <div id="respond"><h3>发表评论</h3>
        <form action="" class="ajax-form" method="post" id="commentform">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <input type="text" name="author" id="author" class="form-control" value="" size="22"
                               tabindex="1" placeholder="昵称">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <input type="text" name="email" id="email" class="form-control" value=""
                               size="22" tabindex="2" placeholder="邮箱 (评论被回复时你能收到通知)">
                    </div>
                </div>
            </div>
            <div class="form-group">
                <textarea name="comment" id="comment" class="form-control" tabindex="4" placeholder="无意义内容我可能不会回复你"
                          rows="3"></textarea>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-xs-4">
                        <input type="text" name="captcha" id="captcha" class="form-control" size="6" maxlength="5"
                               tabindex="4" placeholder="验证码">
                    </div>
                    <div class="col-xs-6" style="padding-left: 0px">
                        <img id="zh-vm" src="{{ route('captcha') }}" class="img-rounded" alt="change vcode"
                             onclick="this.src='{{ route('captcha') }}?r=' + Math.random()"
                             style="vertical-align:middle;">
                    </div>
                </div>
            </div>
            <div class="form-group">
                <input class="btn btn-default" name="submit" type="submit" id="submit" tabindex="5" value="提交留言">
                <input class="btn btn-default" name="reset" type="reset" id="reset" tabindex="6" value="重写">
                <span id="ajax-post-msg" style="display: none"></span>
            </div>
        </form>
        <div class="clear"></div>
    </div>
</div>

@section('js')
    @parent
    <script type="text/javascript">
        let Comment = function () {
            this.id = '{{ $id }}';
            this.type = '{{ $type }}';
            this.parentId = 0;
        };

        Comment.prototype = {
            setParentId: function (parentId) {
                this.parentId = parentId;
            },
            submit: function (e) {
                this.showMessage('正在提交。。。');
                // alert('正在开发');
            },
            showMessage(message) {
                let messagePanel = $('#ajax-post-msg');
                messagePanel.show().addClass('text-primary').html(message)

                setTimeout(function () {
                    messagePanel.hide().text('').removeClass('text-primary text-danger');
                }, 3000)
            }
        };

        let comment = new Comment();
        $('#submit').on('click', function () {
            comment.submit();
            return false;
        })
    </script>
@endsection
