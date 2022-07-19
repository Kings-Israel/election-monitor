<?php

use App\Models\User\User;
use Faker\Generator as Faker;


/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(User::class, function (Faker $faker) {
    static $password;

    $gender = ['male','female'];
    $role = ['agent','admin']; 
    $allocated_area = [            
' SIVETA PRIMARY SCH                                   ',             
' SYOMAVUO NUR SCH                                     ' ,            
' SYOMUKII PRIMARY SCH                                 ' ,            
' SYUMBETI FEEDER SCHOOL.                              '  ,           
' THARAKA PRIMARY SCH                                  '   ,          
' THUA PRIMARY SCH                                     '    ,         
' TII PRIMARY SCH                                      '     ,        
' TONDORA PRIMARY SCH                                  '      ,       
' TSEIKURU PRIMARY SCH                                 '       ,      
' TSEIKURU SEC                                         '        ,     
' TULANDULI PRIMARY SCH                                '         ,    
' TWIMYUA PRIMARY SCH                                  '          ,   
' TYAA/KAMUTHALE SEC SCH                               '           ,  
' USUENI PRIMARY SCH                                   '            , 
' WIKIMUU NUR SCH                                      '             ,
' WIKITHUKI NUR SCH                                    '             ,
' BARAKA PRIMARY                                       '             ,
' BIDII PRIMARY                                        '             ,
' CHAKA RELI PRIMARY SCHOOL                            '             ,
' CHAMUKA PRIMARY                                      '             ,
' CHARAGITA PRIMARY                                    '             ,
' GATHANJI PRIMARY                                     '             ,
' GATIMU PRIMARY                                       '             ,
' GATITU PRIMARY                                       '             ,
' GATUMBIRO PRIMARY                                    '             ,
' GIKENO PRIMARY                                       '             ,
' GIKINGI PRIMARY                                      '             ,
' IGNATIO MURAI PRIMARY SCHOOL                         '             ,
' JACARANDA PRIMARY                                    '             ,
' KAHINGO PRIMARY                                      '             ,
' KAMUKUNJI PRIMARY                                    '             ,
' KAMUKWA SIMBA NURSERY                                '             ,
' KANGUI PRIMARY SCHOOL                                '             ,
' KANGUI YOUTH POLYTECHNIC                             '             ,
' KANGUU PRIMARY                                       '             ,
' KARANDI PRIMARY                                      '             ,
' KIANIA NURSERY SCHOOL                                '             ,
' KIANJATA PRIMARY                                     '             ,
' KIBATHI PRIMARY                                      '             ,
' KIHEO PRIMARY                                        '             ,
' KIRIMA PRIMARY                                       '             ,
' KIRIMANGAI PRIMARY                                   '             ,
' LESIRKO PRIMARY                                      '             ,
' MADARAKA PRIMARY                                     '             ,
' MAHUA PRIMARY                                        '             ,
' MATINDIRI FARMERS SOCIETY                            '             ,
' MATINDIRI PRIMARY                                    '             ,
' MUCHEMI PRIMARY                                      '             ,
' MUNGA PRIMARY                                        '             ,
' MUUNGANO PRIMARY                                     '             ,
' MWENJA PRIMARY                                       '             ,
' NGANO PRIMARY                                        '             ,
' NGATHA PRIMARY                                       '             ,
' NYAIROKO PRIMARY                                     '             ,
' OL JORO OROK A.H.I.T.I                               '             ,
' OL JORO OROK PRIMARY                                 '             ,
' ORAIMUTA PRIMARY SCHOOL                              '             ,
' RIVERSIDE PRIMARY                                    '             ,
' RUIRU PRIMARY                                        '             ,
' SABUGO PRIMARY                                       '             ,
' SILIBWET PRIMARY                                     '             ,
' THAYU NURSERY SCHOOL                                 '             ,
' UHURU PRIMARY                                        '             ,
' UIGUANO PRIMARY                                      '             ,
' WANJURA SECONDARY                                    '             ,
' WERU PRIMARY                                         '             ,
' A.C OL KALOU PRIMARY                                 '             ,
' CCM DUNDORI PRIMARY                                  '             ,
' CIIRA PRIMARY                                        '             ,
' GACHWE PRIMARY                                       '             ,
' GICHUMBU PRIMARY SCHOOL                              '             ,
' GITHIMA PRIMARY                                      '             ,
' GITHUNGURI PRIMARY                                   '             ,
' GITUAMBA PRIMARY                                     '             ,
' HARAMBEE NURSERY SCHOOL                              '             ,
' HUHOINI PRIMARY                                      '             ,
' HUHOINI UNDUGU ACA PRI                               '             ,
' KAGAA PRIMARY                                        '             ,
' KAHIGU PRIMARY                                       '             ,
' KAMANDE PRIMARY                                      '             
    ];

    return [
        'first_name'       => $faker->firstName,
        'last_name'        => $faker->lastName,
        'email'            => $faker->unique()->safeEmail,
        'phone'            => $faker->unique()->e164PhoneNumber,
        'role'             => $role[rand(0, count($role) - 1)],
        'gender'           => $gender[rand(0, count($gender) - 1)],
        'allocated_area'   => $allocated_area[rand(0, count($allocated_area) - 1)],
        'password'         => $password ?: $password = bcrypt('password'),
        'remember_token'   => str_random(10),
        'activation_token' => str_random(10),
        'status'           => 'offline',
    ];
});
