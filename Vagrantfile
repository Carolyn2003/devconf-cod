# encoding: utf-8
# -*- mode: ruby -*-
# vi: set ft=ruby :

Vagrant.configure(2) do |config|
  config.vm.box = "fedora/27-cloud-base"
  config.ssh.insert_key = false
  config.ssh.forward_agent = true
  config.vm.hostname = "ocw.local"
  config.vm.define :vagrant_fedora_dev do |vagrant_host|
    vagrant_host.vm.provider :libvirt do |domain|
      domain.cpus = 2
      domain.memory = 2048
      domain.nested = true
      #domain.cpu_mode = "host-model" #having this flag set makes the vm not launch for me --langdon
    end

    vagrant_host.vm.synced_folder ".", "/vagrant", disabled: true
    vagrant_host.vm.synced_folder ".", "/home/vagrant", type: "rsync", disabled: true

    vagrant_host.vm.provision 'shell', inline: "dnf install -y @'Web Server' drush php-opcache php-mysqlnd mariadb-server", privileged: true
    vagrant_host.vm.provision 'shell', inline: "systemctl enable httpd.service mariadb.service", privileged: true
    vagrant_host.vm.provision 'shell', inline: "systemctl start httpd.service mariadb.service", privileged: true
    vagrant_host.vm.provision 'shell', inline: "mysqladmin -u root password 'Carolyn20' || :", privileged: true
    vagrant_host.vm.provision 'shell', inline: "mysqladmin create devconf_site -u root -pCarolyn20 || :", privileged: true
    vagrant_host.vm.provision 'shell', inline: "setsebool -P httpd_can_network_connect_db=1", privileged: true
    vagrant_host.vm.provision 'shell', inline: "setsebool -P httpd_can_sendmail=1", privileged: true
    vagrant_host.vm.provision 'shell', inline: "setsebool -P httpd_unified=1", privileged: true
#    vagrant_host.vm.provision 'shell', inline: "sed -i 's/Require local/Require all granted/' /etc/httpd/conf.d/drupal7.conf", privileged: true
#    vagrant_host.vm.provision 'shell', inline: "firewall-cmd --add-service=http --permanent", privileged: true
#    vagrant_host.vm.provision 'shell', inline: "firewall-cmd --reload", privileged: true
    vagrant_host.vm.provision 'shell', inline: "drush dl --destination=/tmp cod-7", privileged: true
    vagrant_host.vm.provision 'shell', inline: "cp -R /tmp/cod-7*/* /var/www/html/ || :", privileged: true
    vagrant_host.vm.provision 'shell', inline: "cp /tmp/cod-7*/.* /var/www/html/ || :", privileged: true
    vagrant_host.vm.provision 'shell', inline: "cp /var/www/html/sites/default/default.settings.php /var/www/html/sites/default/settings.php", privileged: true
    vagrant_host.vm.provision 'shell', inline: "chmod 0775 /var/www/html/sites/default/settings.php", privileged: true
    vagrant_host.vm.provision 'shell', inline: "chown root:apache -R /var/www/html", privileged: true
    vagrant_host.vm.provision 'shell', inline: "chmod 0775 -R /var/www/html", privileged: true
    vagrant_host.vm.provision 'shell', inline: "usermod -a -G apache vagrant", privileged: true

    vagrant_host.vm.provision 'shell', inline: "systemctl restart httpd", privileged: true

    #when everything is done
    #"vagrant ssh" # to get to the machine
    #sudo mysql -D mysql -u root -psuperSecret #log in to mysql
    #GRANT ALL PRIVILEGES ON myd8site.* TO 'sqluser'@'localhost' IDENTIFIED BY 'superSecret';
    #FLUSH PRIVILEGES;
    #QUIT;

  end
end
