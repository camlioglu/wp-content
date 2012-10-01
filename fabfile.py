from fabric.api import *
from fabric.contrib.console import confirm
from fabric.context_managers import cd
from fabric.contrib.files import sed, exists

env.hosts = ['wrktg.com']
env.public_html = '~/public_html/'
env.wp_config = '~/wp-config.php'
env.wp_content = env.public_html + '/wp-content'
env.user = 'wrktg'

def fix_permissions(path=env.public_html):
	'''Fix permissions in a directory'''
	run('find %s -type d -exec chmod 755 {} \;' % path)
	run('find %s -type f -exec chmod 644 {} \;' % path)

def pull():
    '''Pull latest git version to live site'''
    with cd(env.wp_content):
        run('git pull origin master')
        run('git submodule update')

def push():
    '''Push from local environment to Github'''
    local('git push origin master')