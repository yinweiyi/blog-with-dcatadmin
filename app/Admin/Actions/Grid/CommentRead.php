<?php

namespace App\Admin\Actions\Grid;

use App\Models\Comment;
use Dcat\Admin\Actions\Response;
use Dcat\Admin\Grid\BatchAction;
use Dcat\Admin\Traits\HasPermissions;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class CommentRead extends BatchAction
{

    /**
     * @var int
     */
    protected $action;

    /**
     * CommentRead constructor.
     * @param null $title
     * @param int $action
     */
    public function __construct($title = null, $action = 1)
    {
        $this->title = $title;
        $this->action = $action;
    }

    /**
     * Handle the action request.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function handle(Request $request)
    {
        $keys = $this->getKey();

        $action = $request->get('action');
        Comment::query()->whereIn('id', $keys)->update(['is_read' => $action]);

        return $this->response()
            ->success('Comment read success!!!')
            ->redirect('/comments');
    }

    /**
     * @return string|array|void
     */
    public function confirm()
    {
        return '您确定要全部' . $this->title . '吗？';
    }

    /**
     * @param Model|Authenticatable|HasPermissions|null $user
     *
     * @return bool
     */
    protected function authorize($user): bool
    {
        return true;
    }

    /**
     * @return array
     */
    protected function parameters()
    {
        return [
            'action' => $this->action
        ];
    }
}
