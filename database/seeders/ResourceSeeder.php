<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ResourceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
{
    $resources = [
        ['nom' => 'SRV-WEB-01', 'type' => 'Serveur Physique', 'statut' => 'Disponible', 'cpu' => 'Intel Xeon 16C', 'ram' => '64GB', 'capacite' => '1TB SSD', 'os' => 'Ubuntu 22.04', 'emplacement' => 'Baie A1'],
        ['nom' => 'VM-DB-PROD', 'type' => 'Machine Virtuelle', 'statut' => 'Disponible', 'cpu' => '8 vCPU', 'ram' => '32GB', 'capacite' => '500GB', 'os' => 'Debian 12', 'emplacement' => 'Cluster-01'],
        ['nom' => 'NAS-DATA-01', 'type' => 'Stockage', 'statut' => 'Disponible', 'cpu' => 'N/A', 'ram' => '16GB', 'capacite' => '20TB', 'os' => 'FreeNAS', 'emplacement' => 'Baie B2'],
        ['nom' => 'SRV-APP-02', 'type' => 'Serveur Physique', 'statut' => 'Maintenance', 'cpu' => 'AMD EPYC 32C', 'ram' => '128GB', 'capacite' => '2TB NVMe', 'os' => 'CentOS 9', 'emplacement' => 'Baie A2'],
        ['nom' => 'VM-TEST-JS', 'type' => 'Machine Virtuelle', 'statut' => 'Réservé', 'cpu' => '2 vCPU', 'ram' => '4GB', 'capacite' => '40GB', 'os' => 'Windows Server', 'emplacement' => 'Cluster-02'],
        ['nom' => 'SW-CORE-01', 'type' => 'Réseau', 'statut' => 'Disponible', 'cpu' => 'N/A', 'ram' => '8GB', 'capacite' => 'N/A', 'os' => 'Cisco IOS', 'emplacement' => 'Baie C1'],
        ['nom' => 'VM-MAIL-01', 'type' => 'Machine Virtuelle', 'statut' => 'Disponible', 'cpu' => '4 vCPU', 'ram' => '8GB', 'capacite' => '200GB', 'os' => 'Ubuntu 20.04', 'emplacement' => 'Cluster-01'],
        ['nom' => 'SRV-BACKUP', 'type' => 'Serveur Physique', 'statut' => 'Disponible', 'cpu' => 'Intel Xeon 8C', 'ram' => '32GB', 'capacite' => '50TB', 'os' => 'RHEL 8', 'emplacement' => 'Baie B3'],
        ['nom' => 'VM-DEV-01', 'type' => 'Machine Virtuelle', 'statut' => 'Maintenance', 'cpu' => '4 vCPU', 'ram' => '16GB', 'capacite' => '100GB', 'os' => 'Ubuntu 22.04', 'emplacement' => 'Cluster-02'],
        ['nom' => 'FIREWALL-01', 'type' => 'Réseau', 'statut' => 'Disponible', 'cpu' => '4 Cores', 'ram' => '8GB', 'capacite' => 'N/A', 'os' => 'pfSense', 'emplacement' => 'Baie C1'],
    ];

    foreach ($resources as $res) {
        \DB::table('resources')->insert($res);
    }
}
}
