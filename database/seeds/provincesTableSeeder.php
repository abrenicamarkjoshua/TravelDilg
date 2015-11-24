<?php

use Illuminate\Database\Seeder;

class provincesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        //
         DB::table('provinces')->delete();
         DB::table('provinces')->insert([ [
            'region_id' => 1,
            'province' => 'ILOCOS NORTE'

        ],
        [
            'region_id' => 1,
            'province' => 'ILOCOS SUR'

        ],
        [
            'region_id' => 1,
            'province' => 'LA UNION'

        ],
        [
            'region_id' => 1,
            'province' => 'PANGASINAN'

        ],
      
      	[
            'region_id' => 2,
            'province' => 'BATANES'

        ],
        [
            'region_id' => 2,
            'province' => 'CAGAYAN'

        ],
        [
            'region_id' => 2,
            'province' => 'NUEVA VISCAYA'

        ],
        [
            'region_id' => 2,
            'province' => 'QUIRINO'

        ],
        

        [
            'region_id' => 3,
            'province' => 'BATAAN'

        ],
        [
            'region_id' => 3,
            'province' => 'BULACAN'

        ],
        [
            'region_id' => 3,
            'province' => 'NUEVA ECIJA'

        ],
        [
            'region_id' => 3,
            'province' => 'PAMPANGA'

        ],
        [
            'region_id' => 3,
            'province' => 'TARLAC'

        ],
        [
            'region_id' => 3,
            'province' => 'ZAMBALES'

        ],
        [
            'region_id' => 3,
            'province' => 'AURORA'

        ],

        [
            'region_id' => 4,
            'province' => 'BATANGAS'

        ],
        [
            'region_id' => 4,
            'province' => 'CAVITE'

        ],
        [
            'region_id' => 4,
            'province' => 'LAGUNA'

        ],
        [
            'region_id' => 4,
            'province' => 'QUEZON'

        ],
        [
            'region_id' => 4,
            'province' => 'RIZAL'

        ],

        [
            'region_id' => 5,
            'province' => 'MARINDUQUE'

        ],
        [
            'region_id' => 5,
            'province' => 'OCCIDENTAL MINDORO'

        ],
        [
            'region_id' => 5,
            'province' => 'PALAWAN'

        ],
        [
            'region_id' => 5,
            'province' => 'ROMBLON'

        ],
        
        [
            'region_id' => 6,
            'province' => 'ALBAY'

        ],
        [
            'region_id' => 6,
            'province' => 'CAMARINES NORTE'

        ],
        [
            'region_id' => 6,
            'province' => 'CAMARINES SUR'

        ],
        [
            'region_id' => 6,
            'province' => 'CATANDUANES'

        ],
        [
            'region_id' => 6,
            'province' => 'MASBATE'

        ],
        [
            'region_id' => 6,
            'province' => 'SORSOGON'

        ],
        
        [
            'region_id' => 7,
            'province' => 'AKLAN'

        ],
        [
            'region_id' => 7,
            'province' => 'ANTIQUE'

        ],
        [
            'region_id' => 7,
            'province' => 'CAPIZ'

        ],
        [
            'region_id' => 7,
            'province' => 'ILOILO'

        ],
        [
            'region_id' => 7,
            'province' => 'NEGROS OCCIDENTAL'

        ],
        [
            'region_id' => 7,
            'province' => 'GUIMARAS'

        ],
        

        [
            'region_id' => 8,
            'province' => 'BOHOL'

        ],
        [
            'region_id' => 8,
            'province' => 'CEBU'

        ],
        [
            'region_id' => 8,
            'province' => 'NEGROS ORIENTAL'

        ],
        [
            'region_id' => 8,
            'province' => 'SIQUIJOR'

        ],

        [
            'region_id' => 9,
            'province' => 'EASTERN SAMAR'

        ],
        [
            'region_id' => 9,
            'province' => 'LEYTE'

        ],
        [
            'region_id' => 9,
            'province' => 'NORTHERN SAMAR'

        ],
        [
            'region_id' => 9,
            'province' => 'SAMAR (WESTERN SAMAR)'

        ],
		[
            'region_id' => 9,
            'province' => 'SOUTHERN LEYTE'

        ],
        [
            'region_id' => 9,
            'province' => 'BILIRAN'

        ],


        [
            'region_id' => 10,
            'province' => 'ZAMBOANGA DEL NORTE'

        ],
        [
            'region_id' => 10,
            'province' => 'ZAMBOANGA DEL SUR'

        ],
		[
            'region_id' => 10,
            'province' => 'ZAMBOANGA SIBUGAY'

        ],
        [
            'region_id' => 10,
            'province' => 'CITY OF ISABELA (Not a Province)'

        ],


		[
            'region_id' => 11,
            'province' => 'BUKIDNON'

        ],
        [
            'region_id' => 11,
            'province' => 'CAMIGUIN'

        ],
		[
            'region_id' => 11,
            'province' => 'LANAO DEL NORTE'

        ],
        [
            'region_id' => 11,
            'province' => 'MISAMIS OCCIDENTAL'

        ],
        [
            'region_id' => 11,
            'province' => 'MISAMIS ORIENTAL'

        ],

		[
            'region_id' => 12,
            'province' => 'DAVAO DEL SUR'

        ],
		[
            'region_id' => 12,
            'province' => 'DAVAO DEL NORTE'

        ],
        [
            'region_id' => 12,
            'province' => 'DAVAO ORIENTAL'

        ],
        [
            'region_id' => 12,
            'province' => 'COMPOSTELA VALLEY'

        ],

        [
            'region_id' => 13,
            'province' => 'COTABATO CITY (Not a Province)'

        ],
		[
            'region_id' => 13,
            'province' => 'NCR, CITY OF MANILA, FIRST DISTRICT (Not a Province)'

        ],
		[
            'region_id' => 13,
            'province' => 'NCR, SECOND DISTRICT (Not a Province)'

        ],
        [
            'region_id' => 13,
            'province' => 'NCR, THIRD DISTRICT (Not a Province)'

        ],
        [
            'region_id' => 13,
            'province' => 'NCR, FOURTH DISTRICT (Not a Province)'

        ],

        [
            'region_id' => 14,
            'province' => 'COTABATO CITY (Not a Province)'

        ],
		[
            'region_id' => 14,
            'province' => 'NCR, CITY OF MANILA, FIRST DISTRICT (Not a Province)'

        ],
		[
            'region_id' => 14,
            'province' => 'NCR, SECOND DISTRICT (Not a Province)'

        ],
        [
            'region_id' => 14,
            'province' => 'NCR, THIRD DISTRICT (Not a Province)'

        ],
        [
            'region_id' => 14,
            'province' => 'NCR, FOURTH DISTRICT (Not a Province)'

        ],
		
		[
            'region_id' => 15,
            'province' => 'ABRA'

        ],
		[
            'region_id' => 15,
            'province' => 'BENGUET'

        ],
		[
            'region_id' => 15,
            'province' => 'IFUGAO'

        ],
        [
            'region_id' => 15,
            'province' => 'KALINGA'

        ],
        [
            'region_id' => 15,
            'province' => 'MOUNTAIN PROVINCE'

        ],
		[
            'region_id' => 15,
            'province' => 'APAYAO'

        ],
		
        [
            'region_id' => 16,
            'province' => 'BASILAN'

        ],
		[
            'region_id' => 16,
            'province' => 'LANAO DEL SUR'

        ],
        [
            'region_id' => 16,
            'province' => 'MAGUINDANAO'

        ],
        [
            'region_id' => 16,
            'province' => 'SULU'

        ],
		[
            'region_id' => 16,
            'province' => 'TAWI-TAWI'

        ],

        [
            'region_id' => 17,
            'province' => 'AGUSAN DEL NORTE'

        ],
		[
            'region_id' => 17,
            'province' => 'AGUSAN DEL SUR'

        ],
        [
            'region_id' => 17,
            'province' => 'SURIGAO DEL NORTE'

        ],
        [
            'region_id' => 17,
            'province' => 'SURIGAO DEL SUR'

        ],
		[
            'region_id' => 17,
            'province' => 'DINAGAT ISLANDS'

        ],

        
		[
            'region_id' => 5,
            'province' => 'ORIENTAL MINDORO'

        ]

        ]
        );

    }
}
