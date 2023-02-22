<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    public function run()
    {
        $permissions = [
            [
                'id'    => 1,
                'title' => 'user_management_access',
            ],
            [
                'id'    => 2,
                'title' => 'permission_create',
            ],
            [
                'id'    => 3,
                'title' => 'permission_edit',
            ],
            [
                'id'    => 4,
                'title' => 'permission_show',
            ],
            [
                'id'    => 5,
                'title' => 'permission_delete',
            ],
            [
                'id'    => 6,
                'title' => 'permission_access',
            ],
            [
                'id'    => 7,
                'title' => 'role_create',
            ],
            [
                'id'    => 8,
                'title' => 'role_edit',
            ],
            [
                'id'    => 9,
                'title' => 'role_show',
            ],
            [
                'id'    => 10,
                'title' => 'role_delete',
            ],
            [
                'id'    => 11,
                'title' => 'role_access',
            ],
            [
                'id'    => 12,
                'title' => 'user_create',
            ],
            [
                'id'    => 13,
                'title' => 'user_edit',
            ],
            [
                'id'    => 14,
                'title' => 'user_show',
            ],
            [
                'id'    => 15,
                'title' => 'user_delete',
            ],
            [
                'id'    => 16,
                'title' => 'user_access',
            ],
            [
                'id'    => 17,
                'title' => 'audit_log_show',
            ],
            [
                'id'    => 18,
                'title' => 'audit_log_access',
            ],
            [
                'id'    => 19,
                'title' => 'user_alert_create',
            ],
            [
                'id'    => 20,
                'title' => 'user_alert_show',
            ],
            [
                'id'    => 21,
                'title' => 'user_alert_delete',
            ],
            [
                'id'    => 22,
                'title' => 'user_alert_access',
            ],
            [
                'id'    => 23,
                'title' => 'content_management_access',
            ],
            [
                'id'    => 24,
                'title' => 'content_category_create',
            ],
            [
                'id'    => 25,
                'title' => 'content_category_edit',
            ],
            [
                'id'    => 26,
                'title' => 'content_category_show',
            ],
            [
                'id'    => 27,
                'title' => 'content_category_delete',
            ],
            [
                'id'    => 28,
                'title' => 'content_category_access',
            ],
            [
                'id'    => 29,
                'title' => 'content_tag_create',
            ],
            [
                'id'    => 30,
                'title' => 'content_tag_edit',
            ],
            [
                'id'    => 31,
                'title' => 'content_tag_show',
            ],
            [
                'id'    => 32,
                'title' => 'content_tag_delete',
            ],
            [
                'id'    => 33,
                'title' => 'content_tag_access',
            ],
            [
                'id'    => 34,
                'title' => 'content_page_create',
            ],
            [
                'id'    => 35,
                'title' => 'content_page_edit',
            ],
            [
                'id'    => 36,
                'title' => 'content_page_show',
            ],
            [
                'id'    => 37,
                'title' => 'content_page_delete',
            ],
            [
                'id'    => 38,
                'title' => 'content_page_access',
            ],
            [
                'id'    => 39,
                'title' => 'faq_management_access',
            ],
            [
                'id'    => 40,
                'title' => 'faq_category_create',
            ],
            [
                'id'    => 41,
                'title' => 'faq_category_edit',
            ],
            [
                'id'    => 42,
                'title' => 'faq_category_show',
            ],
            [
                'id'    => 43,
                'title' => 'faq_category_delete',
            ],
            [
                'id'    => 44,
                'title' => 'faq_category_access',
            ],
            [
                'id'    => 45,
                'title' => 'faq_question_create',
            ],
            [
                'id'    => 46,
                'title' => 'faq_question_edit',
            ],
            [
                'id'    => 47,
                'title' => 'faq_question_show',
            ],
            [
                'id'    => 48,
                'title' => 'faq_question_delete',
            ],
            [
                'id'    => 49,
                'title' => 'faq_question_access',
            ],
            [
                'id'    => 50,
                'title' => 'property_type_create',
            ],
            [
                'id'    => 51,
                'title' => 'property_type_edit',
            ],
            [
                'id'    => 52,
                'title' => 'property_type_show',
            ],
            [
                'id'    => 53,
                'title' => 'property_type_delete',
            ],
            [
                'id'    => 54,
                'title' => 'property_type_access',
            ],
            [
                'id'    => 55,
                'title' => 'type_of_house_create',
            ],
            [
                'id'    => 56,
                'title' => 'type_of_house_edit',
            ],
            [
                'id'    => 57,
                'title' => 'type_of_house_show',
            ],
            [
                'id'    => 58,
                'title' => 'type_of_house_delete',
            ],
            [
                'id'    => 59,
                'title' => 'type_of_house_access',
            ],
            [
                'id'    => 60,
                'title' => 'type_adm_doc_create',
            ],
            [
                'id'    => 61,
                'title' => 'type_adm_doc_edit',
            ],
            [
                'id'    => 62,
                'title' => 'type_adm_doc_show',
            ],
            [
                'id'    => 63,
                'title' => 'type_adm_doc_delete',
            ],
            [
                'id'    => 64,
                'title' => 'type_adm_doc_access',
            ],
            [
                'id'    => 65,
                'title' => 'land_category_create',
            ],
            [
                'id'    => 66,
                'title' => 'land_category_edit',
            ],
            [
                'id'    => 67,
                'title' => 'land_category_show',
            ],
            [
                'id'    => 68,
                'title' => 'land_category_delete',
            ],
            [
                'id'    => 69,
                'title' => 'land_category_access',
            ],
            [
                'id'    => 70,
                'title' => 'unit_measure_create',
            ],
            [
                'id'    => 71,
                'title' => 'unit_measure_edit',
            ],
            [
                'id'    => 72,
                'title' => 'unit_measure_show',
            ],
            [
                'id'    => 73,
                'title' => 'unit_measure_delete',
            ],
            [
                'id'    => 74,
                'title' => 'unit_measure_access',
            ],
            [
                'id'    => 75,
                'title' => 'type_of_wheel_create',
            ],
            [
                'id'    => 76,
                'title' => 'type_of_wheel_edit',
            ],
            [
                'id'    => 77,
                'title' => 'type_of_wheel_show',
            ],
            [
                'id'    => 78,
                'title' => 'type_of_wheel_delete',
            ],
            [
                'id'    => 79,
                'title' => 'type_of_wheel_access',
            ],
            [
                'id'    => 80,
                'title' => 'type_of_utility_create',
            ],
            [
                'id'    => 81,
                'title' => 'type_of_utility_edit',
            ],
            [
                'id'    => 82,
                'title' => 'type_of_utility_show',
            ],
            [
                'id'    => 83,
                'title' => 'type_of_utility_delete',
            ],
            [
                'id'    => 84,
                'title' => 'type_of_utility_access',
            ],
            [
                'id'    => 85,
                'title' => 'motricity_type_create',
            ],
            [
                'id'    => 86,
                'title' => 'motricity_type_edit',
            ],
            [
                'id'    => 87,
                'title' => 'motricity_type_show',
            ],
            [
                'id'    => 88,
                'title' => 'motricity_type_delete',
            ],
            [
                'id'    => 89,
                'title' => 'motricity_type_access',
            ],
            [
                'id'    => 90,
                'title' => 'model_of_vehicle_create',
            ],
            [
                'id'    => 91,
                'title' => 'model_of_vehicle_edit',
            ],
            [
                'id'    => 92,
                'title' => 'model_of_vehicle_show',
            ],
            [
                'id'    => 93,
                'title' => 'model_of_vehicle_delete',
            ],
            [
                'id'    => 94,
                'title' => 'model_of_vehicle_access',
            ],
            [
                'id'    => 95,
                'title' => 'rim_type_create',
            ],
            [
                'id'    => 96,
                'title' => 'rim_type_edit',
            ],
            [
                'id'    => 97,
                'title' => 'rim_type_show',
            ],
            [
                'id'    => 98,
                'title' => 'rim_type_delete',
            ],
            [
                'id'    => 99,
                'title' => 'rim_type_access',
            ],
            [
                'id'    => 100,
                'title' => 'color_type_create',
            ],
            [
                'id'    => 101,
                'title' => 'color_type_edit',
            ],
            [
                'id'    => 102,
                'title' => 'color_type_show',
            ],
            [
                'id'    => 103,
                'title' => 'color_type_delete',
            ],
            [
                'id'    => 104,
                'title' => 'color_type_access',
            ],
            [
                'id'    => 105,
                'title' => 'gear_box_create',
            ],
            [
                'id'    => 106,
                'title' => 'gear_box_edit',
            ],
            [
                'id'    => 107,
                'title' => 'gear_box_show',
            ],
            [
                'id'    => 108,
                'title' => 'gear_box_delete',
            ],
            [
                'id'    => 109,
                'title' => 'gear_box_access',
            ],
            [
                'id'    => 110,
                'title' => 'vehicle_type_create',
            ],
            [
                'id'    => 111,
                'title' => 'vehicle_type_edit',
            ],
            [
                'id'    => 112,
                'title' => 'vehicle_type_show',
            ],
            [
                'id'    => 113,
                'title' => 'vehicle_type_delete',
            ],
            [
                'id'    => 114,
                'title' => 'vehicle_type_access',
            ],
            [
                'id'    => 115,
                'title' => 'type_of_trip_create',
            ],
            [
                'id'    => 116,
                'title' => 'type_of_trip_edit',
            ],
            [
                'id'    => 117,
                'title' => 'type_of_trip_show',
            ],
            [
                'id'    => 118,
                'title' => 'type_of_trip_delete',
            ],
            [
                'id'    => 119,
                'title' => 'type_of_trip_access',
            ],
            [
                'id'    => 120,
                'title' => 'convenience_type_create',
            ],
            [
                'id'    => 121,
                'title' => 'convenience_type_edit',
            ],
            [
                'id'    => 122,
                'title' => 'convenience_type_show',
            ],
            [
                'id'    => 123,
                'title' => 'convenience_type_delete',
            ],
            [
                'id'    => 124,
                'title' => 'convenience_type_access',
            ],
            [
                'id'    => 125,
                'title' => 'hosting_type_create',
            ],
            [
                'id'    => 126,
                'title' => 'hosting_type_edit',
            ],
            [
                'id'    => 127,
                'title' => 'hosting_type_show',
            ],
            [
                'id'    => 128,
                'title' => 'hosting_type_delete',
            ],
            [
                'id'    => 129,
                'title' => 'hosting_type_access',
            ],
            [
                'id'    => 130,
                'title' => 'servicesinclu_create',
            ],
            [
                'id'    => 131,
                'title' => 'servicesinclu_edit',
            ],
            [
                'id'    => 132,
                'title' => 'servicesinclu_show',
            ],
            [
                'id'    => 133,
                'title' => 'servicesinclu_delete',
            ],
            [
                'id'    => 134,
                'title' => 'servicesinclu_access',
            ],
            [
                'id'    => 135,
                'title' => 'objecttype_create',
            ],
            [
                'id'    => 136,
                'title' => 'objecttype_edit',
            ],
            [
                'id'    => 137,
                'title' => 'objecttype_show',
            ],
            [
                'id'    => 138,
                'title' => 'objecttype_delete',
            ],
            [
                'id'    => 139,
                'title' => 'objecttype_access',
            ],
            [
                'id'    => 140,
                'title' => 'rating_type_create',
            ],
            [
                'id'    => 141,
                'title' => 'rating_type_edit',
            ],
            [
                'id'    => 142,
                'title' => 'rating_type_show',
            ],
            [
                'id'    => 143,
                'title' => 'rating_type_delete',
            ],
            [
                'id'    => 144,
                'title' => 'rating_type_access',
            ],
            [
                'id'    => 145,
                'title' => 'type_offer_create',
            ],
            [
                'id'    => 146,
                'title' => 'type_offer_edit',
            ],
            [
                'id'    => 147,
                'title' => 'type_offer_show',
            ],
            [
                'id'    => 148,
                'title' => 'type_offer_delete',
            ],
            [
                'id'    => 149,
                'title' => 'type_offer_access',
            ],
            [
                'id'    => 150,
                'title' => 'payment_mode_create',
            ],
            [
                'id'    => 151,
                'title' => 'payment_mode_edit',
            ],
            [
                'id'    => 152,
                'title' => 'payment_mode_show',
            ],
            [
                'id'    => 153,
                'title' => 'payment_mode_delete',
            ],
            [
                'id'    => 154,
                'title' => 'payment_mode_access',
            ],
            [
                'id'    => 155,
                'title' => 'emergency_level_create',
            ],
            [
                'id'    => 156,
                'title' => 'emergency_level_edit',
            ],
            [
                'id'    => 157,
                'title' => 'emergency_level_show',
            ],
            [
                'id'    => 158,
                'title' => 'emergency_level_delete',
            ],
            [
                'id'    => 159,
                'title' => 'emergency_level_access',
            ],
            [
                'id'    => 160,
                'title' => 'reason_create',
            ],
            [
                'id'    => 161,
                'title' => 'reason_edit',
            ],
            [
                'id'    => 162,
                'title' => 'reason_show',
            ],
            [
                'id'    => 163,
                'title' => 'reason_delete',
            ],
            [
                'id'    => 164,
                'title' => 'reason_access',
            ],
            [
                'id'    => 165,
                'title' => 'day_create',
            ],
            [
                'id'    => 166,
                'title' => 'day_edit',
            ],
            [
                'id'    => 167,
                'title' => 'day_show',
            ],
            [
                'id'    => 168,
                'title' => 'day_delete',
            ],
            [
                'id'    => 169,
                'title' => 'day_access',
            ],
            [
                'id'    => 170,
                'title' => 'type_of_medium_create',
            ],
            [
                'id'    => 171,
                'title' => 'type_of_medium_edit',
            ],
            [
                'id'    => 172,
                'title' => 'type_of_medium_show',
            ],
            [
                'id'    => 173,
                'title' => 'type_of_medium_delete',
            ],
            [
                'id'    => 174,
                'title' => 'type_of_medium_access',
            ],
            [
                'id'    => 175,
                'title' => 'set_country_create',
            ],
            [
                'id'    => 176,
                'title' => 'set_country_edit',
            ],
            [
                'id'    => 177,
                'title' => 'set_country_show',
            ],
            [
                'id'    => 178,
                'title' => 'set_country_delete',
            ],
            [
                'id'    => 179,
                'title' => 'set_country_access',
            ],
            [
                'id'    => 180,
                'title' => 'city_create',
            ],
            [
                'id'    => 181,
                'title' => 'city_edit',
            ],
            [
                'id'    => 182,
                'title' => 'city_show',
            ],
            [
                'id'    => 183,
                'title' => 'city_delete',
            ],
            [
                'id'    => 184,
                'title' => 'city_access',
            ],
            [
                'id'    => 185,
                'title' => 'quartier_create',
            ],
            [
                'id'    => 186,
                'title' => 'quartier_edit',
            ],
            [
                'id'    => 187,
                'title' => 'quartier_show',
            ],
            [
                'id'    => 188,
                'title' => 'quartier_delete',
            ],
            [
                'id'    => 189,
                'title' => 'quartier_access',
            ],
            [
                'id'    => 190,
                'title' => 'areas_of_service_create',
            ],
            [
                'id'    => 191,
                'title' => 'areas_of_service_edit',
            ],
            [
                'id'    => 192,
                'title' => 'areas_of_service_show',
            ],
            [
                'id'    => 193,
                'title' => 'areas_of_service_delete',
            ],
            [
                'id'    => 194,
                'title' => 'areas_of_service_access',
            ],
            [
                'id'    => 195,
                'title' => 'configuration_create',
            ],
            [
                'id'    => 196,
                'title' => 'configuration_edit',
            ],
            [
                'id'    => 197,
                'title' => 'configuration_show',
            ],
            [
                'id'    => 198,
                'title' => 'configuration_delete',
            ],
            [
                'id'    => 199,
                'title' => 'configuration_access',
            ],
            [
                'id'    => 200,
                'title' => 'list_of_country_create',
            ],
            [
                'id'    => 201,
                'title' => 'list_of_country_edit',
            ],
            [
                'id'    => 202,
                'title' => 'list_of_country_show',
            ],
            [
                'id'    => 203,
                'title' => 'list_of_country_delete',
            ],
            [
                'id'    => 204,
                'title' => 'list_of_country_access',
            ],
            [
                'id'    => 205,
                'title' => 'list_statut_create',
            ],
            [
                'id'    => 206,
                'title' => 'list_statut_edit',
            ],
            [
                'id'    => 207,
                'title' => 'list_statut_show',
            ],
            [
                'id'    => 208,
                'title' => 'list_statut_delete',
            ],
            [
                'id'    => 209,
                'title' => 'list_statut_access',
            ],
            [
                'id'    => 210,
                'title' => 'parameter_user_type_create',
            ],
            [
                'id'    => 211,
                'title' => 'parameter_user_type_edit',
            ],
            [
                'id'    => 212,
                'title' => 'parameter_user_type_show',
            ],
            [
                'id'    => 213,
                'title' => 'parameter_user_type_delete',
            ],
            [
                'id'    => 214,
                'title' => 'parameter_user_type_access',
            ],
            [
                'id'    => 215,
                'title' => 'favori_create',
            ],
            [
                'id'    => 216,
                'title' => 'favori_edit',
            ],
            [
                'id'    => 217,
                'title' => 'favori_show',
            ],
            [
                'id'    => 218,
                'title' => 'favori_delete',
            ],
            [
                'id'    => 219,
                'title' => 'favori_access',
            ],
            [
                'id'    => 220,
                'title' => 'brand_create',
            ],
            [
                'id'    => 221,
                'title' => 'brand_edit',
            ],
            [
                'id'    => 222,
                'title' => 'brand_show',
            ],
            [
                'id'    => 223,
                'title' => 'brand_delete',
            ],
            [
                'id'    => 224,
                'title' => 'brand_access',
            ],
            [
                'id'    => 225,
                'title' => 'comment_create',
            ],
            [
                'id'    => 226,
                'title' => 'comment_edit',
            ],
            [
                'id'    => 227,
                'title' => 'comment_show',
            ],
            [
                'id'    => 228,
                'title' => 'comment_delete',
            ],
            [
                'id'    => 229,
                'title' => 'comment_access',
            ],
            [
                'id'    => 230,
                'title' => 'license_create',
            ],
            [
                'id'    => 231,
                'title' => 'license_edit',
            ],
            [
                'id'    => 232,
                'title' => 'license_show',
            ],
            [
                'id'    => 233,
                'title' => 'license_delete',
            ],
            [
                'id'    => 234,
                'title' => 'license_access',
            ],
            [
                'id'    => 235,
                'title' => 'notification_create',
            ],
            [
                'id'    => 236,
                'title' => 'notification_edit',
            ],
            [
                'id'    => 237,
                'title' => 'notification_show',
            ],
            [
                'id'    => 238,
                'title' => 'notification_delete',
            ],
            [
                'id'    => 239,
                'title' => 'notification_access',
            ],
            [
                'id'    => 240,
                'title' => 'carpooling_vehicle_create',
            ],
            [
                'id'    => 241,
                'title' => 'carpooling_vehicle_edit',
            ],
            [
                'id'    => 242,
                'title' => 'carpooling_vehicle_show',
            ],
            [
                'id'    => 243,
                'title' => 'carpooling_vehicle_delete',
            ],
            [
                'id'    => 244,
                'title' => 'carpooling_vehicle_access',
            ],
            [
                'id'    => 245,
                'title' => 'energy_type_create',
            ],
            [
                'id'    => 246,
                'title' => 'energy_type_edit',
            ],
            [
                'id'    => 247,
                'title' => 'energy_type_show',
            ],
            [
                'id'    => 248,
                'title' => 'energy_type_delete',
            ],
            [
                'id'    => 249,
                'title' => 'energy_type_access',
            ],
            [
                'id'    => 250,
                'title' => 'rating_create',
            ],
            [
                'id'    => 251,
                'title' => 'rating_edit',
            ],
            [
                'id'    => 252,
                'title' => 'rating_show',
            ],
            [
                'id'    => 253,
                'title' => 'rating_delete',
            ],
            [
                'id'    => 254,
                'title' => 'rating_access',
            ],
            [
                'id'    => 255,
                'title' => 'trip_create',
            ],
            [
                'id'    => 256,
                'title' => 'trip_edit',
            ],
            [
                'id'    => 257,
                'title' => 'trip_show',
            ],
            [
                'id'    => 258,
                'title' => 'trip_delete',
            ],
            [
                'id'    => 259,
                'title' => 'trip_access',
            ],
            [
                'id'    => 260,
                'title' => 'trip_frequency_create',
            ],
            [
                'id'    => 261,
                'title' => 'trip_frequency_edit',
            ],
            [
                'id'    => 262,
                'title' => 'trip_frequency_show',
            ],
            [
                'id'    => 263,
                'title' => 'trip_frequency_delete',
            ],
            [
                'id'    => 264,
                'title' => 'trip_frequency_access',
            ],
            [
                'id'    => 265,
                'title' => 'accept_cgu_create',
            ],
            [
                'id'    => 266,
                'title' => 'accept_cgu_edit',
            ],
            [
                'id'    => 267,
                'title' => 'accept_cgu_show',
            ],
            [
                'id'    => 268,
                'title' => 'accept_cgu_delete',
            ],
            [
                'id'    => 269,
                'title' => 'accept_cgu_access',
            ],
            [
                'id'    => 270,
                'title' => 'userservice_create',
            ],
            [
                'id'    => 271,
                'title' => 'userservice_edit',
            ],
            [
                'id'    => 272,
                'title' => 'userservice_show',
            ],
            [
                'id'    => 273,
                'title' => 'userservice_delete',
            ],
            [
                'id'    => 274,
                'title' => 'userservice_access',
            ],
            [
                'id'    => 275,
                'title' => 'userparam_create',
            ],
            [
                'id'    => 276,
                'title' => 'userparam_edit',
            ],
            [
                'id'    => 277,
                'title' => 'userparam_show',
            ],
            [
                'id'    => 278,
                'title' => 'userparam_delete',
            ],
            [
                'id'    => 279,
                'title' => 'userparam_access',
            ],
            [
                'id'    => 280,
                'title' => 'signaler_create',
            ],
            [
                'id'    => 281,
                'title' => 'signaler_edit',
            ],
            [
                'id'    => 282,
                'title' => 'signaler_show',
            ],
            [
                'id'    => 283,
                'title' => 'signaler_delete',
            ],
            [
                'id'    => 284,
                'title' => 'signaler_access',
            ],
            [
                'id'    => 285,
                'title' => 'approve_create',
            ],
            [
                'id'    => 286,
                'title' => 'approve_edit',
            ],
            [
                'id'    => 287,
                'title' => 'approve_show',
            ],
            [
                'id'    => 288,
                'title' => 'approve_delete',
            ],
            [
                'id'    => 289,
                'title' => 'approve_access',
            ],
            [
                'id'    => 290,
                'title' => 'carpool_create',
            ],
            [
                'id'    => 291,
                'title' => 'carpool_edit',
            ],
            [
                'id'    => 292,
                'title' => 'carpool_show',
            ],
            [
                'id'    => 293,
                'title' => 'carpool_delete',
            ],
            [
                'id'    => 294,
                'title' => 'carpool_access',
            ],
            [
                'id'    => 295,
                'title' => 'release_good_create',
            ],
            [
                'id'    => 296,
                'title' => 'release_good_edit',
            ],
            [
                'id'    => 297,
                'title' => 'release_good_show',
            ],
            [
                'id'    => 298,
                'title' => 'release_good_delete',
            ],
            [
                'id'    => 299,
                'title' => 'release_good_access',
            ],
            [
                'id'    => 300,
                'title' => 'release_good_convenience_create',
            ],
            [
                'id'    => 301,
                'title' => 'release_good_convenience_edit',
            ],
            [
                'id'    => 302,
                'title' => 'release_good_convenience_show',
            ],
            [
                'id'    => 303,
                'title' => 'release_good_convenience_delete',
            ],
            [
                'id'    => 304,
                'title' => 'release_good_convenience_access',
            ],
            [
                'id'    => 305,
                'title' => 'local_create',
            ],
            [
                'id'    => 306,
                'title' => 'local_edit',
            ],
            [
                'id'    => 307,
                'title' => 'local_show',
            ],
            [
                'id'    => 308,
                'title' => 'local_delete',
            ],
            [
                'id'    => 309,
                'title' => 'local_access',
            ],
            [
                'id'    => 310,
                'title' => 'land_create',
            ],
            [
                'id'    => 311,
                'title' => 'land_edit',
            ],
            [
                'id'    => 312,
                'title' => 'land_show',
            ],
            [
                'id'    => 313,
                'title' => 'land_delete',
            ],
            [
                'id'    => 314,
                'title' => 'land_access',
            ],
            [
                'id'    => 315,
                'title' => 'local_convenience_create',
            ],
            [
                'id'    => 316,
                'title' => 'local_convenience_edit',
            ],
            [
                'id'    => 317,
                'title' => 'local_convenience_show',
            ],
            [
                'id'    => 318,
                'title' => 'local_convenience_delete',
            ],
            [
                'id'    => 319,
                'title' => 'local_convenience_access',
            ],
            [
                'id'    => 320,
                'title' => 'land_doc_create',
            ],
            [
                'id'    => 321,
                'title' => 'land_doc_edit',
            ],
            [
                'id'    => 322,
                'title' => 'land_doc_show',
            ],
            [
                'id'    => 323,
                'title' => 'land_doc_delete',
            ],
            [
                'id'    => 324,
                'title' => 'land_doc_access',
            ],
            [
                'id'    => 325,
                'title' => 'lodging_create',
            ],
            [
                'id'    => 326,
                'title' => 'lodging_edit',
            ],
            [
                'id'    => 327,
                'title' => 'lodging_show',
            ],
            [
                'id'    => 328,
                'title' => 'lodging_delete',
            ],
            [
                'id'    => 329,
                'title' => 'lodging_access',
            ],
            [
                'id'    => 330,
                'title' => 'hosting_availability_create',
            ],
            [
                'id'    => 331,
                'title' => 'hosting_availability_edit',
            ],
            [
                'id'    => 332,
                'title' => 'hosting_availability_show',
            ],
            [
                'id'    => 333,
                'title' => 'hosting_availability_delete',
            ],
            [
                'id'    => 334,
                'title' => 'hosting_availability_access',
            ],
            [
                'id'    => 335,
                'title' => 'hostingspec_create',
            ],
            [
                'id'    => 336,
                'title' => 'hostingspec_edit',
            ],
            [
                'id'    => 337,
                'title' => 'hostingspec_show',
            ],
            [
                'id'    => 338,
                'title' => 'hostingspec_delete',
            ],
            [
                'id'    => 339,
                'title' => 'hostingspec_access',
            ],
            [
                'id'    => 340,
                'title' => 'hosting_service_create',
            ],
            [
                'id'    => 341,
                'title' => 'hosting_service_edit',
            ],
            [
                'id'    => 342,
                'title' => 'hosting_service_show',
            ],
            [
                'id'    => 343,
                'title' => 'hosting_service_delete',
            ],
            [
                'id'    => 344,
                'title' => 'hosting_service_access',
            ],
            [
                'id'    => 345,
                'title' => 'allmedia_create',
            ],
            [
                'id'    => 346,
                'title' => 'allmedia_edit',
            ],
            [
                'id'    => 347,
                'title' => 'allmedia_show',
            ],
            [
                'id'    => 348,
                'title' => 'allmedia_delete',
            ],
            [
                'id'    => 349,
                'title' => 'allmedia_access',
            ],
            [
                'id'    => 350,
                'title' => 'sell_rent_car_create',
            ],
            [
                'id'    => 351,
                'title' => 'sell_rent_car_edit',
            ],
            [
                'id'    => 352,
                'title' => 'sell_rent_car_show',
            ],
            [
                'id'    => 353,
                'title' => 'sell_rent_car_delete',
            ],
            [
                'id'    => 354,
                'title' => 'sell_rent_car_access',
            ],
            [
                'id'    => 355,
                'title' => 'vehicle_availability_create',
            ],
            [
                'id'    => 356,
                'title' => 'vehicle_availability_edit',
            ],
            [
                'id'    => 357,
                'title' => 'vehicle_availability_show',
            ],
            [
                'id'    => 358,
                'title' => 'vehicle_availability_delete',
            ],
            [
                'id'    => 359,
                'title' => 'vehicle_availability_access',
            ],
            [
                'id'    => 360,
                'title' => 'need_vehicle_create',
            ],
            [
                'id'    => 361,
                'title' => 'need_vehicle_edit',
            ],
            [
                'id'    => 362,
                'title' => 'need_vehicle_show',
            ],
            [
                'id'    => 363,
                'title' => 'need_vehicle_delete',
            ],
            [
                'id'    => 364,
                'title' => 'need_vehicle_access',
            ],
            [
                'id'    => 365,
                'title' => 'besoin_hebergement_create',
            ],
            [
                'id'    => 366,
                'title' => 'besoin_hebergement_edit',
            ],
            [
                'id'    => 367,
                'title' => 'besoin_hebergement_show',
            ],
            [
                'id'    => 368,
                'title' => 'besoin_hebergement_delete',
            ],
            [
                'id'    => 369,
                'title' => 'besoin_hebergement_access',
            ],
            [
                'id'    => 370,
                'title' => 'need_land_create',
            ],
            [
                'id'    => 371,
                'title' => 'need_land_edit',
            ],
            [
                'id'    => 372,
                'title' => 'need_land_show',
            ],
            [
                'id'    => 373,
                'title' => 'need_land_delete',
            ],
            [
                'id'    => 374,
                'title' => 'need_land_access',
            ],
            [
                'id'    => 375,
                'title' => 'besoin_local_create',
            ],
            [
                'id'    => 376,
                'title' => 'besoin_local_edit',
            ],
            [
                'id'    => 377,
                'title' => 'besoin_local_show',
            ],
            [
                'id'    => 378,
                'title' => 'besoin_local_delete',
            ],
            [
                'id'    => 379,
                'title' => 'besoin_local_access',
            ],
            [
                'id'    => 380,
                'title' => 'parametres_systeme_access',
            ],
            [
                'id'    => 381,
                'title' => 'profile_password_edit',
            ],
        ];

        Permission::insert($permissions);
    }
}
