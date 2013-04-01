
set :stages, %w( production staging )
set :default_stage, 'staging'
require "capistrano/ext/multistage"

set :application,     'womble'
set :scm,             :git
set :repository,      "git@github.com:sparksp/#{application}.git"
set :ssh_options,     { forward_agent: true }
# set :scm_username,    ''
set(:deploy_to)       { "~/apps/#{application}/#{stage}" }
set :deploy_via,      :remote_cache
set :keep_releases,   3
set :use_sudo,        false
set :shared_children, %w( config storage storage/cache storage/logs storage/meta storage/sessions storage/views )

default_run_options[:pty] = true

# List of servers to deploy to
role :web, 'womble.me.uk'

# We will ask which branch to deploy; default = current
# http://nathanhoad.net/deploy-from-a-git-tag-with-capistrano
set :branch do
  default_tag = `git rev-parse --abbrev-ref HEAD`.strip

  tag = Capistrano::CLI.ui.ask "Branch to deploy (make sure to push first): [#{default_tag}] "
  tag = default_tag if tag.empty?
  tag
end unless exists?(:branch)

# An example task, just gets the uname of each server
task :uname do
  run 'uname -a'
end

# Fetch vendor packages
task :composer_install, :roles => :web do
	run "/usr/local/php54/bin/php ~/bin/composer.phar install -d #{current_release} -n -q -o --no-progress"
end

# Link up the shared children
task :create_symlinks, :roles => :web do
	run "rm -rf #{current_release}/app/storage && ln -s #{shared_path}/storage #{current_release}/app/storage"
	run "rm -rf #{current_release}/app/config/#{stage} && ln -s #{shared_path}/config #{current_release}/app/config/#{stage}"
	run "[ -e #{shared_path}/htaccess ] && rm -rf #{current_release}/public/.htaccess && cp #{shared_path}/htaccess #{current_release}/public/.htaccess"
end

task :fix_perms, :roles => :web do
	run "chmod -R g-w #{current_release}"
end

after 'deploy:update', 'deploy:cleanup'
after 'deploy:finalize_update', :composer_install
after 'deploy:finalize_update', :create_symlinks
after 'deploy:finalize_update', :fix_perms
