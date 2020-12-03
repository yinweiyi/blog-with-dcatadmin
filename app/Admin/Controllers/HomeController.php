<?php

namespace App\Admin\Controllers;

use App\Admin\Metrics\Examples;
use App\Http\Controllers\Controller;
use Dcat\Admin\Controllers\Dashboard;
use Dcat\Admin\Grid;
use Dcat\Admin\Layout\Column;
use Dcat\Admin\Layout\Content;
use Dcat\Admin\Layout\Row;
use Dcat\Admin\Widgets\Card;
use Dcat\Admin\Widgets\Table;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index(Content $content)
    {
        return $content
            ->header('首页')
            ->description('系统信息...')
            ->body(function (Row $row) {
                $row->column(8, $this->systemInfo());
                $row->column(4, $this->directoryAuthority());
                $row->column(12, $this->phpExtends());

                /*$row->column(6, function (Column $column) {
                    $column->row(Dashboard::title());
                    $column->row(new Examples\Tickets());
                });

                $row->column(6, function (Column $column) {
                    $column->row(function (Row $row) {
                        $row->column(6, new Examples\NewUsers());
                        $row->column(6, new Examples\NewDevices());
                    });

                    $column->row(new Examples\Sessions());
                    $column->row(new Examples\ProductOrders());
                });*/
            });
    }

    /**
     * @return Card
     */
    protected function systemInfo()
    {
        return Card::make('系统信息', function () {
            $mysqlVersion = DB::select("select version() as version")[0]->version;
            return new Table(
                [
                    ['操作系统', exec(' cat /proc/version')],
                    ['运行环境', request()->server('SERVER_SOFTWARE')],
                    ['PHP环境', sprintf('%s (%s)', PHP_VERSION, php_sapi_name())],
                    ['MYSQL版本', $mysqlVersion],
                    ['上传大小限制', sprintf('%s (PHP环境允许上传附件的大小限制)', ini_get('upload_max_filesize'))],
                    ['表单大小限制', sprintf('%sM (会影响上传附件大小)', ini_get('max_file_uploads'))],
                    ['执行时间限制', sprintf('%s秒 (0表示无限制)', ini_get('max_execution_time'))],
                    ['运行内存限制', sprintf('%s (允许PHP脚本使用的最大内存)', ini_get('memory_limit'))],
                    ['剩余空间', human_filesize(disk_free_space('.'))],
                ]
            );
        });
    }

    /**
     * 目录权限
     *
     * @return Card
     */
    protected function directoryAuthority()
    {
        return Card::make('目录权限', function () {
            $storagePath = storage_path();
            return new Table(
                [
                    ['storage', sprintf('%s %s', is_readable($storagePath) ? '可读' : '不可读', is_writeable($storagePath) ? '可写' : '不可写')],
                ]
            );
        });
    }

    /**
     * php扩展
     *
     * @return Card
     */
    protected function phpExtends()
    {
        return Card::make('PHP扩展', function () {
            return new Table(
                [
                    ['openssl', extension_loaded('openssl') ? '正常' : '异常', '框架', 'openSSL 是一个强大的安全套接字层密码库，囊括主要的密码算法、常用的密钥和证书封装管理功能及SSL协议，并提供丰富的应用程序供测试或其它目的使用。'],
                    ['mbstring', extension_loaded('mbstring') ? '正常' : '异常', '框架', 'mbstring 提供了针对多字节字符串的函数，能够帮你处理 PHP 中的多字节编码。 除此以外，mbstring 还能在可能的字符编码之间相互进行编码转换。'],
                    ['gd2', extension_loaded('gd') ? '正常' : '异常', '验证码', 'gd2 提供了创建和处理包括 GIF， PNG， JPEG， WBMP 以及 XPM 在内的多种格式的图像。'],
                    ['cURL', extension_loaded('curl') ? '正常' : '异常', '推送', 'PHP支持的由Daniel Stenberg创建的libcurl库允许你与各种的服务器使用各种类型的协议进行连接和通讯。'],
                    ['fileinfo', extension_loaded('fileinfo') ? '正常' : '异常', '上传', 'fileinfo 中的函数通过在文件的给定位置查找特定的 魔术 字节序列 来猜测文件的内容类型以及编码。 虽然不是百分百的精确， 但是通常情况下能够很好的工作。'],
                ]
            );
        });
    }
}
