<div class="well" id="comment-form-container">
    <div id="respond"><h3>发表评论</h3>
        <form class="ajax-form" method="post" id="commentform">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <input type="text" name="nickname" id="nickname" class="form-control" value="" size="22"
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
                <textarea name="content" id="content" class="form-control" tabindex="4" placeholder="ヾﾉ≧∀≦)o来啊，快活啊!"
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
            this.parentId = 4;
            this.messageClass = 'text-primary text-danger';
            this.timer = null;
        };

        Comment.prototype = {
            setParentId: function (parentId) {
                this.parentId = parentId;
            },
            submit: function (e) {
                let that = this;
                let nickname = $('#nickname').val();
                if (!nickname) {
                    that.showMessage('请填写昵称', 'danger');
                    return;
                }
                let content = $('#content').val();
                if (!content) {
                    that.showMessage('请填写评论内容', 'danger');
                    return;
                }

                let captcha = $('#captcha').val();
                if (!captcha) {
                    that.showMessage('请填写验证码', 'danger');
                    return;
                }

                let data = {
                    type: this.type,
                    id: this.id,
                    parent_id: this.parentId,
                    nickname: nickname,
                    content: content,
                    captcha: captcha
                };

                let email = $('#email').val();
                if (email) {
                    data.email = email;
                }

                $.ajax({
                    url: '{{ route('comment.store') }}',
                    type: 'post',
                    dataType: 'json',
                    data: data,
                    beforeSend: function () {
                        that.showMessage('正在提交。。。');
                    },
                    success: function (data, textStatus) {
                        if (data.code !== 200) {
                            that.showMessage(data.message, 'danger');
                            return;
                        }
                        that.showMessage(data.message, 'primary', 2000, function () {
                            location.href = that.getCommentPosition(data.data.comment_id);
                        });
                    }
                })
                // alert('正在开发');
            },
            getCommentPosition: function (commentId) {
                let href = location.href, parsedUrl = href.split('#');
                return parsedUrl[0] + '#comment-' + commentId;

            },
            showMessage: function (message, type, timeout, callback) {
                if (this.timer) {
                    clearTimeout(this.timer);
                    this.timer = null;
                }

                let messagePanel = $('#ajax-post-msg');
                type = type || 'primary';
                timeout = timeout || 2000;
                messagePanel.show().addClass('text-' + type).html(message)
                this.timer = setTimeout(function () {
                    if (callback) {
                        callback.call();
                        return;
                    }
                    messagePanel.hide().text('').removeClass(this.messageClass);
                }, timeout)
            }
        };

        let comment = new Comment();
        $('#submit').on('click', function () {
            comment.submit();
            return false;
        })
    </script>
@endsection
