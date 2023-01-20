# -*- mode: ruby -*-
# vi: set ft=ruby  :

machines = {
  "master" => {"memory" => "2048", "cpu" => "2", "clone" => "true", "ipA" => "11", "ipB" => "201", "image" => "ubuntu/jammy64"},
  "node01" => {"memory" => "2048", "cpu" => "2", "clone" => "true", "ipA" => "12", "ipB" => "202", "image" => "ubuntu/jammy64"},
  "node02" => {"memory" => "2048", "cpu" => "2", "clone" => "true", "ipA" => "13", "ipB" => "203", "image" => "ubuntu/jammy64"},
  "node03" => {"memory" => "2048", "cpu" => "2", "clone" => "true", "ipA" => "14", "ipB" => "204", "image" => "ubuntu/jammy64"}
}

Vagrant.configure("2") do |config|

  machines.each do |name, conf|
    config.vm.define "#{name}" do |machine|
      machine.vm.box = "#{conf["image"]}"
      machine.vm.hostname = "#{name}"
      machine.vm.network "private_network", ip: "192.168.56.#{conf["ipA"]}", bridge: "wlp4s0"
      machine.vm.network "public_network", ip: "192.168.31.#{conf["ipB"]}", bridge: "wlp4s0"
#      machine.vm.network "public_network", ip: "172.16.0.#{conf["ipB"]}", bridge: "eno1"
      machine.vm.provider "virtualbox" do |vb|
        vb.name = "#{name}"
        vb.memory = conf["memory"]
        vb.cpus = conf["cpu"]
        vb.linked_clone = conf["clone"]
      end
      machine.vm.provision "shell", path: "docker.sh"
      
      if "#{name}" == "master"
        machine.vm.provision "shell", path: "master.sh"
      else
        machine.vm.provision "shell", path: "worker.sh"
      end

    end
  end
end
