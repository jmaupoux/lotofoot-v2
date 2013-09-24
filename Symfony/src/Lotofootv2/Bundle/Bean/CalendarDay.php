<?php

namespace Lotofootv2\Bundle\Bean;

class CalendarDay
{
	private $number;
	
	//'l' or 'cl'
	private $type;
	
	private $before;
	
	private $opened;
	
	public function __construct($number, $type, $before){
		$this->number = $number;
		$this->type = $type;
		$this->before = $before;
		$this->opened = false;	
	}	
	
	public function getNumber(){
		return $this->number;	
	}
	
	public function getType(){
		return $this->type;
	}
	
	public function getBefore(){
		return $this->before;
	}
	
	public function getOpened(){
		return $this->opened;
	}
	
	public function setOpened(){
		$this->opened = true;
	}
}