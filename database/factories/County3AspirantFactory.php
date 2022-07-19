<?php

use App\Models\Aspirant\Aspirant;
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

$factory->define(Aspirant::class, function (Faker $faker) {
    

    $political_parties = 
    [
                        'Orange Democratic Movement',                
                        'Federal Party Of Kenya',                    
                        'Economic Freedom Party',                    
                        'Shirikisho Party Of Kenya',                 
                        'United Democratic Party',                   
                        'Thirdway Alliance Kenya',                   
                        'The National Vision Party',                 
                        'Social Democratic Party Of Kenya',          
                        'Safina',                                    
                        'Progressive Party Of Kenya',                
                        'Peoples Empowerment Party',                 
                        'Peoples Democratic Party',                  
                        'Party Of National Unity',                   
                        'Party Of Independent Candidates Of Kenya',  
                        'Party Of Democratic Unity',                 
                        'Party For Development And Reform ',         
                        'New Democrats',                             
                        'National Rainbow Coalition - Kenya',        
                        'Nationa Rainbow Coalition',                 
                        'Muungano Party',                            
                        'Mazingira Greens Party Of Kenya',           
                        'Maendeleo Democratic Party',                
                        'Maendeleo Chap Chap Party',                 
                        'Kenya Patriots Party',                      
                        'Kenya African National Union',              
                        'Jubilee',                                   
                        'Green Congress Of Kenya',                   
                        'Frontier Alliance Party',                   
                        'Forum For Restoration Of Democracy - Kenya',
                        'Farmers Party',                             
                        'Empowerment And Liberation Party',          
                        'Devolution Party Of Kenya',                 
                        'Democratic Congress',                       
                        'Citizens Convention Party',                 
                        'Chama Mwangaza Daima',                      
                        'Chama Cha Uzalendo',                        
                        'Amani National Congress',                   
                        'Agano Party',     
    ];

    $electoral_area = 
    [
                        'NAIROBI',           
                        'MOMBASA',           
                        'KWALE',             
                        'KILIFI',            
                        'TANA RIVER',        
                        'LAMU',              
                        'TAITA TAVETA',      
                        'GARISSA',           
                        'WAJIR',             
                        'MANDERA',           
                        'MARSABIT',          
                        'ISIOLO',            
                        'MERU',              
                        'THARAKA',           
                        'EMBU',              
                        'KITUI',             
                        'MACHAKOS',          
                        'NYANDARUA',         
                        'NYERI',             
                        'KIRINYAGA',         
                        'MURANGA',           
                        'KIAMBU',            
                        'TURKANA',           
                        'WEST POKOT',        
                        'SAMBURU',           
                        'UASIN GISHU',       
                        'ELGEYO - MARAKWET', 
                        'NANDI',             
                        'BARINGO',           
                        'LAIKIPIA',          
                        'NAKURU',            
                        'NAROK',             
                        'KAJIADO',           
                        'MAKUEN',            
                        'KERICHO',           
                        'KAKAMEGA',          
                        'VIHIGA',            
                        'BUNGOMA',           
                        'BUSIA',             
                        'SIAYA',             
                        'HOMABAY',           
                        'MIGORI',            
                        'KISII',             
                        'BOMET',             
                        'NYAMIRA',           
                        'KISUMU',            
                        'TRANS NZOIA', 
    ];
    return [
        'full_name'            => $faker->name,
        'uuid'                 => Str::uuid()->toString(),
        'political_party'       => $political_parties[rand(0, count($political_parties) - 1)],
        'electoral_position'   => 'County Woman Member of National Assembly',
        'electoral_area'       => $electoral_area[rand(0, count($electoral_area) - 1)],
    ];
});
   