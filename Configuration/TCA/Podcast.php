<?php
if (!defined ('TYPO3_MODE'))	die ('Access denied.');

$TCA['tx_podcast_domain_model_podcast'] = array(
	'ctrl' => $TCA['tx_podcast_domain_model_podcast']['ctrl'],
	'interface' => array(
		'showRecordFieldList' => 'title,subtitle,description,copyright,tstamp,image,episodes,categories,author,technical_contact,website,itunes,itunesblock,keywords,publication_date'
	),
	'types' => array(
		'1' => array('showitem' => '--div--;LLL:EXT:podcast/Resources/Private/Language/locallang_db.xml:tx_podcast_domain_model_podcast.episodes,episodes,
									--div--;LLL:EXT:podcast/Resources/Private/Language/locallang_db.xml:tx_podcast_domain_model_podcast.tab.description,title,subtitle,description,publication_date,tstamp,image,
									--div--;LLL:EXT:podcast/Resources/Private/Language/locallang_db.xml:tx_podcast_domain_model_podcast.tab.itunes,categories,keywords,itunes;;2;;,
									--div--;LLL:EXT:podcast/Resources/Private/Language/locallang_db.xml:tx_podcast_domain_model_podcast.tab.contact,author;;3;;,copyright')
	), 
	'palettes' => array(
		'1' => array('showitem' => ''),
		'2' => array('showitem' => 'explicit, itunesblock'),
		'3' => array('showitem' => 'technical_contact,website'),
	), 
	'columns' => array(
		'sys_language_uid' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.php:LGL.language',
			'config' => array(
				'type' => 'select',
				'foreign_table' => 'sys_language',
				'foreign_table_where' => 'ORDER BY sys_language.title',
				'items' => array(
					array('LLL:EXT:lang/locallang_general.php:LGL.allLanguages',-1),
					array('LLL:EXT:lang/locallang_general.php:LGL.default_value',0)
				)
			)
		),
		'tstamp' => array(
			'exclude' => 1,
			'label' => 'pub date',
			'config' => array(
				'type'=>'none',
				'format' => 'date',
				'eval' => 'date',
			)
		),
		'l18n_parent' => array(
			'displayCond' => 'FIELD:sys_language_uid:>:0',
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.php:LGL.l18n_parent',
			'config' => array(
				'type' => 'select',
				'items' => array(
					array('', 0),
				),
				'foreign_table' => 'tx_podcast_domain_model_podcast',
				'foreign_table_where' => 'AND tx_podcast_domain_model_podcast.uid=###REC_FIELD_l18n_parent### AND tx_podcast_domain_model_podcast.sys_language_uid IN (-1,0)',
			)
		),
		'l18n_diffsource' => array(
			'config'=>array(
				'type'=>'passthrough')
		),
		't3ver_label' => array(
			'displayCond' => 'FIELD:t3ver_label:REQ:true',
			'label' => 'LLL:EXT:lang/locallang_general.php:LGL.versionLabel',
			'config' => array(
				'type'=>'none',
				'cols' => 27
			)
		),
		'hidden' => array(
			'exclude' => 1,
			'label'	  => 'LLL:EXT:lang/locallang_general.xml:LGL.hidden',
			'config'  => array(
				'type' => 'check'
			)
		),
		'title' => array(
			'exclude' => 0,
			'label'	  => 'LLL:EXT:podcast/Resources/Private/Language/locallang_db.xml:tx_podcast_domain_model_podcast.title',
			'config'  => array(
				'type' => 'input',
				'size' => 45,			 
				'eval' => 'trim,required',
			)
		),
		'subtitle' => array(
			'exclude' => 0,
			'label'	  => 'LLL:EXT:podcast/Resources/Private/Language/locallang_db.xml:tx_podcast_domain_model_podcast.subtitle',
			'config'  => array(
				'type' => 'input',
				'size' => 45,
				'eval' => 'trim,required',
			)
		),
		'description' => array(
			'exclude' => 0,
			'label'	  => 'LLL:EXT:podcast/Resources/Private/Language/locallang_db.xml:tx_podcast_domain_model_podcast.description',
			'config'  => array(
				'type' => 'text',
				'cols' => '45', 
				'rows' => '5',
				'eval' => 'required,trim',
				'max' => '1000',
			)
		),
		'publication_date' => array(
			'exclude' => 0,
			'label'	  => 'LLL:EXT:podcast/Resources/Private/Language/locallang_db.xml:tx_podcast_domain_model_podcast.publication_date',
			'config'  => array(
				'type' => 'input',
				'size' => 12,
				'max' => 15,
				'eval' => 'datetime,required',
				'checkbox' => '0',
				'default' => time(),
			)
		),
		'copyright' => array(
			'exclude' => 0,
			'label'	  => 'LLL:EXT:podcast/Resources/Private/Language/locallang_db.xml:tx_podcast_domain_model_podcast.copyright',
			'config'  => array(
				'type' => 'input',
				'size' => 45,
				'eval' => 'trim',
			)
		),
		'image' => array(
			'exclude' => 0,
			'label'	  => 'LLL:EXT:podcast/Resources/Private/Language/locallang_db.xml:tx_podcast_domain_model_podcast.image',
			'config' => array (
				'type' => 'group',
				'internal_type' => 'file',
				'allowed' => 'png,jpeg,jpg',	
				'max_size' => 4500, 
				'uploadfolder' => 'uploads/tx_podcast',
				'show_thumbs' => 1, 
				'size' => 1,	
				'minitems' => 0,
				'maxitems' => 1,
			)
		),
		'episodes' => array(
			'exclude' => 0,
			'label'	  => 'LLL:EXT:podcast/Resources/Private/Language/locallang_db.xml:tx_podcast_domain_model_podcast.episodes',
			'config' => array(
				'type' => 'select',
				'foreign_table' => 'tx_podcast_domain_model_episode',
				'foreign_table_where' => ' AND tx_podcast_domain_model_episode.sys_language_uid IN (-1,0) ORDER BY tx_podcast_domain_model_episode.publication_date DESC',
				'MM' => 'tx_podcast_podcast_episode_mm',
				'renderMode' => 'singlebox',
				'size' => 10,
				'autoSizeMax' => 30,
				'maxitems' => 9999,
				'multiple' => 1,
				'wizards' => array(
					'_POSITION' => 'right',
					'_PADDING' => 10,
					'add' => Array(
						'type' => 'script',
						'title' => 'Create new',
						'icon' => 'add.gif',
						'params' => array(
							'table'=> 'tx_podcast_domain_model_episode',
							'pid' => '###CURRENT_PID###',
							'setValue' => 'prepend'
							),
						'script' => 'wizard_add.php',
					),
					'edit' => array(
						'type' => 'popup',
						'title' => 'Edit',
						'script' => 'wizard_edit.php',
						'icon' => 'edit2.gif',
						'popup_onlyOpenIfSelected' => 1,
						'JSopenParams' => 'height=350,width=580,status=0,menubar=0,scrollbars=1',
						),

				),
			),
		),
		'categories' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:podcast/Resources/Private/Language/locallang_db.xml:tx_podcast_domain_model_podcast.categories',
			'config' => array(
				'type' => 'select',
				'renderMode' => 'tree',
				'treeConfig' => array(
					'childrenField' => 'subcategory',
					'appearance' => array(
						'expandAll' => TRUE,
						'showHeader' => TRUE,
					),
				),
				'foreign_table' => 'tx_podcast_domain_model_category',
				//'foreign_table_where' => ' AND tx_podcast_domain_model_category.sys_language_uid IN (-1,0) ORDER BY tx_podcast_domain_model_category.title ASC',
				//'MM' => 'tx_podcast_podcast_category_mm',
				//'renderMode' => 'checkbox',
				'size' => 10,
				'autoSizeMax' => 30,
				'maxitems' => 9999,
				'multiple' => 0,
				'wizards' => array(
					'_POSITION' => 'top',
					'_PADDING' => 5,
					'_VERTICAL' => 0,
					'edit' => array(
						'type' => 'popup',
						'title' => 'Edit',
						'script' => 'wizard_edit.php',
						'icon' => 'edit2.gif',
						'popup_onlyOpenIfSelected' => 1,
						'JSopenParams' => 'height=350,width=580,status=0,menubar=0,scrollbars=1',
						),
					'add' => Array(
						'type' => 'script',
						'title' => 'Create new',
						'icon' => 'add.gif',
						'params' => array(
							'table' => 'tx_podcast_domain_model_category',
							'pid' => '###CURRENT_PID###',
							'setValue' => 'prepend'
							),
						'script' => 'wizard_add.php',
					),
				),
			),
		),		  
		'author' => array(
			'exclude' => 0,
			'label'	  => 'LLL:EXT:podcast/Resources/Private/Language/locallang_db.xml:tx_podcast_domain_model_podcast.author',
			'config' => array(
				'type' => 'select',	 
				//'renderMode' => 'checkbox',
				'size' => 1,
				'maxitems' => 1,
				'multiple' => 1,
				'foreign_table' => 'tx_podcast_domain_model_person',
				'foreign_table_where' => 'AND tx_podcast_domain_model_person.pid=###CURRENT_PID###',
				'eval' => 'trim,required',
				'wizards' => array(
					 '_POSITION' => 'right',
					 '_PADDING' => 1,
					 '_VERTICAL' => 0,
					 'edit' => array(
						 'type' => 'popup',
						 'title' => 'Edit',
						 'script' => 'wizard_edit.php',
						 'icon' => 'edit2.gif',
						 'popup_onlyOpenIfSelected' => 1,
						 'JSopenParams' => 'height=645,width=645,status=0,menubar=0,scrollbars=1',
					 ),
					 'add' => array(
						 'type' => 'script',
						 'title' => 'Create New Author',
						 'icon' => 'add.gif',
						 'params' => array(
							 'table'=>'tx_podcast_domain_model_person',
							 'pid' => '###CURRENT_PID###',
							 'setValue' => 'prepend'
						 ),
						 'script' => 'wizard_add.php',
					 ),
				 ),
			),
		),
		'technical_contact' => array(
			'exclude' => 0,
			'label'	  => 'LLL:EXT:podcast/Resources/Private/Language/locallang_db.xml:tx_podcast_domain_model_podcast.technical_contact',
			'config' => array(
				'type' => 'select',	 
				'type' => 'select',	 
				//'renderMode' => 'checkbox',
				'size' => 1,
				'maxitems' => 1,
				'multiple' => 1,
				'foreign_table' => 'tx_podcast_domain_model_person',
				'foreign_table_where' => 'AND tx_podcast_domain_model_person.pid=###CURRENT_PID###',
				'eval' => 'trim,required',
				'wizards' => array(
					 '_POSITION' => 'right',
					 '_PADDING' => 1,
					 '_VERTICAL' => 0,
					 'edit' => array(
						 'type' => 'popup',
						 'title' => 'Edit',
						 'script' => 'wizard_edit.php',
						 'icon' => 'edit2.gif',
						 'popup_onlyOpenIfSelected' => 1,
						 'JSopenParams' => 'height=645,width=645,status=0,menubar=0,scrollbars=1',
					 ),
					 'add' => array(
						 'type' => 'script',
						 'title' => 'Create New Technical Contact',
						 'icon' => 'add.gif',
						 'params' => array(
							 'table'=>'tx_podcast_domain_model_person',
							 'pid' => '###CURRENT_PID###',
							 'setValue' => 'prepend'
						 ),
						 'script' => 'wizard_add.php',
					 ),
				 ),
			),
		),
		'website' => array(
			'exclude' => 0,
			'label'	  => 'LLL:EXT:podcast/Resources/Private/Language/locallang_db.xml:tx_podcast_domain_model_podcast.website',
			'config' => array(
				'type' => 'select',	 
				//'renderMode' => 'checkbox',
				'size' => 1,
				'maxitems' => 1,
				'multiple' => 0,
				'foreign_table' => 'tx_podcast_domain_model_website',
				'foreign_table_where' => 'AND tx_podcast_domain_model_website.pid=###CURRENT_PID###',
				'wizards' => array(
					 '_POSITION' => 'right',
					 '_PADDING' => 1,
					 '_VERTICAL' => 0,
					 'edit' => array(
						 'type' => 'popup',
						 'title' => 'Edit',
						 'script' => 'wizard_edit.php',
						 'icon' => 'edit2.gif',
						 'popup_onlyOpenIfSelected' => 1,
						 'JSopenParams' => 'height=650,width=650,status=0,menubar=0,scrollbars=1',
					 ),
					 'add' => array(
						 'type' => 'script',
						 'title' => 'Create New Website',
						 'icon' => 'add.gif',
						 'params' => array(
							 'table'=>'tx_podcast_domain_model_website',
							 'pid' => '###CURRENT_PID###',
							 'setValue' => 'prepend'
						 ),
						 'script' => 'wizard_add.php',
					 ),
				 ),
			),
		),
		'keywords' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:podcast/Resources/Private/Language/locallang_db.xml:tx_podcast_domain_model_podcast.keywords',
			'config' => array(
				'type' => 'select',
				'foreign_table' => 'tx_podcast_domain_model_keyword',
				"foreign_table_where" => " AND sys_language_uid=###REC_FIELD_sys_language_uid### ORDER BY tx_podcast_domain_model_keyword.title",
				'MM' => 'tx_podcast_podcast_keyword_mm',
				'renderMode' => 'checkbox',
				'size' => 10,
				'autoSizeMax' => 30,
				'maxitems' => 9999,
				'multiple' => 0,
				'wizards' => array(
					 '_POSITION' => 'right',
					 '_PADDING' => 1,
					 '_VERTICAL' => 0,
					/*'edit' => array(
						'type' => 'popup',
						'title' => 'Edit',
						'script' => 'wizard_edit.php',
						'icon' => 'edit2.gif',
						'popup_onlyOpenIfSelected' => 1,
						'JSopenParams' => 'height=350,width=580,status=0,menubar=0,scrollbars=1',
						),*/
					'add' => Array(
						'type' => 'script',
						'title' => 'Create new',
						'icon' => 'add.gif',
						'params' => array(
							'table' => 'tx_podcast_domain_model_keyword',
							'pid' => '###CURRENT_PID###',
							'setValue' => 'prepend'
							),
						'script' => 'wizard_add.php',
					),
				),
			),
		),	
		'explicit' => array(		
			'exclude' => 1, 
			'label'	  => 'LLL:EXT:podcast/Resources/Private/Language/locallang_db.xml:tx_podcast_domain_model_podcast.explicit',
			'config' => array(
				'type' => 'select',
				'items' => array(
					array('LLL:EXT:podcast/Resources/Private/Language/locallang_db.xml:tx_podcast_domain_model_podcast.explicit.no', 'no'),
					array('LLL:EXT:podcast/Resources/Private/Language/locallang_db.xml:tx_podcast_domain_model_podcast.explicit.clean', 'clean'),
					array('LLL:EXT:podcast/Resources/Private/Language/locallang_db.xml:tx_podcast_domain_model_podcast.explicit.yes', 'yes'),
				),
			),
		),
		'itunesblock' => array(
			'exclude' => 1,
			'label'	  => 'LLL:EXT:podcast/Resources/Private/Language/locallang_db.xml:tx_podcast_domain_model_podcast.itunesblock',
			'config' => array(
				'type' => 'check',
				'default' => '0',
			)
		), 
		'itunes' => array(
			'exclude' => 1,
			'label'	  => 'LLL:EXT:podcast/Resources/Private/Language/locallang_db.xml:tx_podcast_domain_model_podcast.itunes',
			'config' => array(
				'type' => 'check',
				'default' => '1',
			)
		),
	),		 
);
?>