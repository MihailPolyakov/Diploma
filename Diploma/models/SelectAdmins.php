<?php
/**
 * 
 */
class SelectAdmins 
{
	//переменная с запросом в БД с администраторами
	public $admins = "SELECT id, login, password FROM users WHERE privilege = 'admin'";
	
}
