set :application, 'wott'
set :repo_url, 'git@github.com:welcoMattic/wott.git'

set :ssh_user, 'welcomattic'
server '195.154.12.162', user: fetch(:ssh_user), roles: %w{web app db}

set :scm, :git

set :format, :pretty
set :log_level, :info
# set :log_level, :debug

set :composer_install_flags, '--no-dev --prefer-dist --no-interaction --optimize-autoloader'

set :linked_files, %w{app/config/parameters.yml}
set :linked_dirs, %w{app/logs web/uploads}

set :keep_releases, 3

set :file_permissions_paths, ["app/logs", "app/cache"]
set :file_permissions_users, ["www-data"]

set :symfony_assets_flags, '--web'
set :symfony_env, 'prod'

before 'deploy:updated', "deploy:set_permissions:acl"

after 'deploy:finishing', 'deploy:cleanup'
after 'deploy:updated', 'deploy:database'