<?php

class m140414_160316_create_project extends CDbMigration
{
	public function up()
	{
	    $userParams = parse_ini_file(dirname(__FILE__).'/../config/user_params.ini');
	    $projName = $userParams['project'];
        $project = Project::model()->find('name=:name', array(':name'=>$projName));
		if($project===null)
		{
            $this->insert('{{project}}',
				array(
					'name' => $projName,
					'description' => 'Default project',
					'status' => '1',
					'crash_reports_per_group_quota' => 100,
					'crash_report_files_disc_quota' => 512,
					'bug_attachment_files_disc_quota' => 100,
					'debug_info_files_disc_quota' => 2048,
					'require_exact_build_age' => 1,
				));
        }

        else
        {
            Yii::log('Project name duplication: '.$projName, 'error');
        }
	}

	public function down()
	{
		echo "m140414_160316_create_project does not support migration down.\n";
		return false;
	}

	/*
	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
	}

	public function safeDown()
	{
	}
	*/
}