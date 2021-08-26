@servers(['web' => 'wayee@ewayee.com'])

@task('deploy', ['on' => 'web'])
cd /www/blog/
git pull
@endtask
