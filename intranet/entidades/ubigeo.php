<?php

	class ubigeo {

		var $ubig_id;
		var $cod;
		var $dpto_cod;
		var $prov_cod;
		var $dist_cod;
		var $nombre;
		var $estado;

		public function getUbigID() {
			return $this->ubig_id;
		}
		public function getCod() {
			return $this->cod;
		}
		public function getDptoCod() {
			return $this->dpto_cod;
		}
		public function getProvCod() {
			return $this->prov_cod;
		}
		public function getDistCod() {
			return $this->dist_cod;
		}
		public function getNombre() {
			return $this->nombre;
		}
		public function getEstado() {
			return $this->estado;
		}

		public function setUbigID($ubig_id) {
			$this->ubig_id = $ubig_id;
		}
		public function setCod($ubig_cod) {
			$this->cod = $ubig_cod;
		}
		public function setDptoCod($ubig_dpto_cod) {
			$this->dpto_cod = $ubig_dpto_cod;
		}
		public function setProvCod($ubig_prov_cod) {
			$this->prov_cod = $ubig_prov_cod;
		}
		public function setDistCod($ubig_dist_cod) {
			$this->dist_cod = $ubig_dist_cod;
		}
		public function setNombre($ubig_nombre) {
			$this->nombre = $ubig_nombre;
		}
		public function setEstado($ubig_estado) {
			$this->estado = $ubig_estado;
		}
	}
