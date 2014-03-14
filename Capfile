set :deploy_config_path, "capistrano/config.rb"
set :stage_config_path, "capistrano/deploy"

# Load DSL and Setup Up Stages
require 'capistrano/setup'

# Includes default deployment tasks
require 'capistrano/deploy'
require 'capistrano/composer'
require 'capistrano/symfony'
require 'capistrano/file-permissions'

# Loads custom tasks from `capistrano/tasks' if you have any defined.
Dir.glob('capistrano/tasks/*.cap').each { |r| import r }