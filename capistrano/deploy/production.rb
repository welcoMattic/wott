set :stage, :production
set :branch, 'master'
set :deploy_to, '/var/www/wott'

role :app, %w{welcomattic@195.154.12.162}
role :web, %w{welcomattic@195.154.12.162}
role :db,  %w{welcomattic@195.154.12.162}

server '195.154.12.162', user: 'welcomattic', roles: %w{web app}, my_property: :my_value
