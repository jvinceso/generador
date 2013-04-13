<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*Autogenered Developed by @jvinceso*/
/* Date : 12-04-2013 20:51:56 */

Class Acceso_model extends CI_Model {

	private $nAccId = '';
	private $nEprId = '';
	private $nUsuId = '';
	private $nFunId = '';
	private $cAccPermiso = '';
	private $fAccFechaInicio = '';
	private $fAccFechaFin = '';
	private $cfAccFirma = '';
	private $cAccEliminado = '';

	//Constructor Acceso_model
	function __construct(){
		parent::__construct();
	}

/*	FUNCIONES SETTER*/
	public function set_nAccId($nAccId){
		$this->nAccId = $nAccId;
	}
	public function set_nEprId($nEprId){
		$this->nEprId = $nEprId;
	}
	public function set_nUsuId($nUsuId){
		$this->nUsuId = $nUsuId;
	}
	public function set_nFunId($nFunId){
		$this->nFunId = $nFunId;
	}
	public function set_cAccPermiso($cAccPermiso){
		$this->cAccPermiso = $cAccPermiso;
	}
	public function set_fAccFechaInicio($fAccFechaInicio){
		$this->fAccFechaInicio = $fAccFechaInicio;
	}
	public function set_fAccFechaFin($fAccFechaFin){
		$this->fAccFechaFin = $fAccFechaFin;
	}
	public function set_cfAccFirma($cfAccFirma){
		$this->cfAccFirma = $cfAccFirma;
	}
	public function set_cAccEliminado($cAccEliminado){
		$this->cAccEliminado = $cAccEliminado;
	}

/*	FUNCIONES GETTER*/
	public function get_nAccId($nAccId){
		return $this->nAccId;
	}
	public function get_nEprId($nEprId){
		return $this->nEprId;
	}
	public function get_nUsuId($nUsuId){
		return $this->nUsuId;
	}
	public function get_nFunId($nFunId){
		return $this->nFunId;
	}
	public function get_cAccPermiso($cAccPermiso){
		return $this->cAccPermiso;
	}
	public function get_fAccFechaInicio($fAccFechaInicio){
		return $this->fAccFechaInicio;
	}
	public function get_fAccFechaFin($fAccFechaFin){
		return $this->fAccFechaFin;
	}
	public function get_cfAccFirma($cfAccFirma){
		return $this->cfAccFirma;
	}
	public function get_cAccEliminado($cAccEliminado){
		return $this->cAccEliminado;
	}
	/*Aqui Va la logica de Tu Modelo*/


	/* Funcion Get Object Acceso */
	public function accesoGet(){
		$this->adampt->Liberar();
		$this->adampt->setParam( $this->get_nAccId() );
		$query = $this->adampt->consulta("USP_XXX_G_Acceso");
		if( count($result) > 0){
			$this->set_nAccId( $query["nAccId"] );
			$this->set_nEprId( $query["nEprId"] );
			$this->set_nUsuId( $query["nUsuId"] );
			$this->set_nFunId( $query["nFunId"] );
			$this->set_cAccPermiso( $query["cAccPermiso"] );
			$this->set_fAccFechaInicio( $query["fAccFechaInicio"] );
			$this->set_fAccFechaFin( $query["fAccFechaFin"] );
			$this->set_cfAccFirma( $query["cfAccFirma"] );
			$this->set_cAccEliminado( $query["cAccEliminado"] );
		}else{
			return null;
		}
	}

	/* Funcion Insertar */
	public function accesoIns(){
		$this->adampt->Liberar();
		$this->adampt->setParam( $this->get_nAccId() );
		$this->adampt->setParam( $this->get_nEprId() );
		$this->adampt->setParam( $this->get_nUsuId() );
		$this->adampt->setParam( $this->get_nFunId() );
		$this->adampt->setParam( $this->get_cAccPermiso() );
		$this->adampt->setParam( $this->get_fAccFechaInicio() );
		$this->adampt->setParam( $this->get_fAccFechaFin() );
		$this->adampt->setParam( $this->get_cfAccFirma() );
		$this->adampt->setParam( $this->get_cAccEliminado() );
		$query = $this->adampt->consulta("USP_XXX_I_Acceso");
		if( count($result) > 0){
			return $result;
		}else{
			return null;
		}
	}

	/* Funcion Select */
	public function accesoQry(){
		$this->adampt->Liberar();
		$this->adampt->setParam( $this->get_nAccId() );
		$this->adampt->setParam( $this->get_nEprId() );
		$this->adampt->setParam( $this->get_nUsuId() );
		$this->adampt->setParam( $this->get_nFunId() );
		$this->adampt->setParam( $this->get_cAccPermiso() );
		$this->adampt->setParam( $this->get_fAccFechaInicio() );
		$this->adampt->setParam( $this->get_fAccFechaFin() );
		$this->adampt->setParam( $this->get_cfAccFirma() );
		$this->adampt->setParam( $this->get_cAccEliminado() );
		$query = $this->adampt->consulta("USP_XXX_S_Acceso");
		if( count($result) > 0){
			return $result;
		}else{
			return null;
		}
	}

	/* Funcion Update */
	public function accesoUpd(){
		$this->adampt->Liberar();
		$this->adampt->setParam( $this->get_nAccId() );
		$this->adampt->setParam( $this->get_nEprId() );
		$this->adampt->setParam( $this->get_nUsuId() );
		$this->adampt->setParam( $this->get_nFunId() );
		$this->adampt->setParam( $this->get_cAccPermiso() );
		$this->adampt->setParam( $this->get_fAccFechaInicio() );
		$this->adampt->setParam( $this->get_fAccFechaFin() );
		$this->adampt->setParam( $this->get_cfAccFirma() );
		$this->adampt->setParam( $this->get_cAccEliminado() );
		$this->adampt->setParamOut1();
		$this->adampt->prepara("USP_XXX_U_Acceso");
		$this->adampt->ejecuta();
		if( $this->adampt->getParamOut1()=="1" ){
			return true;
		}else{
			return false;
		}
	}

	/* Funcion Delete */
	public function accesoDel(){
		$this->adampt->Liberar();
		$this->adampt->setParam( $this->get_nAccId() );
		$this->adampt->setParam( $this->get_nEprId() );
		$this->adampt->setParam( $this->get_nUsuId() );
		$this->adampt->setParam( $this->get_nFunId() );
		$this->adampt->setParam( $this->get_cAccPermiso() );
		$this->adampt->setParam( $this->get_fAccFechaInicio() );
		$this->adampt->setParam( $this->get_fAccFechaFin() );
		$this->adampt->setParam( $this->get_cfAccFirma() );
		$this->adampt->setParam( $this->get_cAccEliminado() );
		$this->adampt->setParamOut1();
		$this->adampt->prepara("USP_XXX_D_Acceso");
		$this->adampt->ejecuta();
		if( $this->adampt->getParamOut1()=="1" ){
			return true;
		}else{
			return false;
		}
	}

}
/* End of file Acceso_model.php */
/* Location: ./application/models/~/Acceso_model.php */
