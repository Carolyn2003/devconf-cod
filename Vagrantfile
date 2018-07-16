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

    vagrant_host.vm.provision 'shell', inline: "dnf install -y @'Web Server' drupal8 drupal8-httpd php-opcache php-mysqlnd mariadb-server", privileged: true
    vagrant_host.vm.provision 'shell', inline: "systemctl enable httpd.service mariadb.service", privileged: true
    vagrant_host.vm.provision 'shell', inline: "systemctl start httpd.service mariadb.service", privileged: true
    vagrant_host.vm.provision 'shell', inline: "mysqladmin -u root password 'superSecret'", privileged: true
    vagrant_host.vm.provision 'shell', inline: "mysqladmin create myd8site -u root -psuperSecret", privileged: true
    vagrant_host.vm.provision 'shell', inline: "setsebool -P httpd_can_network_connect_db=1", privileged: true
    vagrant_host.vm.provision 'shell', inline: "setsebool -P httpd_can_sendmail=1", privileged: true
    vagrant_host.vm.provision 'shell', inline: "sed -i 's/Require local/Require all granted/' /etc/httpd/conf.d/drupal8.conf", privileged: true
#    vagrant_host.vm.provision 'shell', inline: "firewall-cmd --add-service=http --permanent", privileged: true
#    vagrant_host.vm.provision 'shell', inline: "firewall-cmd --reload", privileged: true
    vagrant_host.vm.provision 'shell', inline: "cp /etc/drupal8/sites/default/default.settings.php /etc/drupal8/sites/default/settings.php", privileged: true
    vagrant_host.vm.provision 'shell', inline: "chmod 666 /etc/drupal8/sites/default/settings.php", privileged: true
    vagrant_host.vm.provision 'shell', inline: "systemctl restart httpd", privileged: true

    #when everything is done
    #"vagrant ssh" # to get to the machine
    #sudo mysql -D mysql -u root -psuperSecret #log in to mysql
    #GRANT ALL PRIVILEGES ON myd8site.* TO 'sqluser'@'localhost' IDENTIFIED BY 'superSecret';
    #FLUSH PRIVILEGES;
    #QUIT;

  end
end

