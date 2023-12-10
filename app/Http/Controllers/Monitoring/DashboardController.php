<?php

namespace App\Http\Controllers\Monitoring;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\DataAsset\FixedAsset;

use function Laravel\Prompts\select;

class DashboardController extends Controller
{
    public function index()
    {
        $query = "SELECT
            id,
            nama_kategori,
            baik,
            buruk,
            (baik + buruk) AS total_kategori
        FROM (
            SELECT
                DISTINCT(ct.id) AS id,
                ct.nama_kategori,
                (
                    SELECT
                        COUNT(*)
                    FROM
                        fixed_assets AS faa
                        JOIN sub_categories AS sct ON sct.id = faa.sub_category_id
                        AND sct.deleted_at IS NULL
                        JOIN categories AS ctt ON ctt.id = sct.categories_id
                        AND ctt.deleted_at IS NULL
                    WHERE
                        ctt.id = ct.id
                        AND faa.kondisi = 'Buruk'
                        AND faa.deleted_at IS NULL        ) AS buruk,
                (
                    SELECT
                        COUNT(*)
                    FROM
                        fixed_assets AS faaa
                        JOIN sub_categories AS sctt ON sctt.id = faaa.sub_category_id
                        AND sctt.deleted_at IS NULL
                        JOIN categories AS cttt ON cttt.id = sctt.categories_id
                        AND cttt.deleted_at IS NULL
                    WHERE
                        cttt.id = ct.id
                        AND faaa.kondisi = 'Baik'
                        AND faaa.deleted_at IS NULL
                ) AS baik
            FROM
                categories AS ct
            WHERE
                ct.deleted_at IS NULL
        ) AS subquery_alias";

        $queryUser = "SELECT
        DISTINCT ON (u.id)
        u.id AS user_id,
        u.nama AS user_name,
        JSON_AGG(
            JSON_BUILD_OBJECT(
            'category_id', c.id,
            'category_name', c.nama_kategori,
            'category_count', category_count
            ) ORDER BY c.id
        ) AS category
        FROM
        users u
        JOIN
        (
            SELECT
            u.id AS user_id,
            c.id AS category_id,
            COUNT(fa.id) AS category_count
            FROM
            users u
            JOIN
            fixed_assets fa ON u.id = fa.user_id
            JOIN
            sub_categories sc ON fa.sub_category_id = sc.id
            JOIN
            categories c ON sc.categories_id = c.id
            WHERE
            u.deleted_at IS NULL
            AND fa.deleted_at IS NULL
            AND c.deleted_at IS NULL
            GROUP BY
            u.id, c.id
        ) AS counts ON u.id = counts.user_id
        JOIN
        categories c ON counts.category_id = c.id
        GROUP BY
        u.id, u.nama
        ORDER BY
        u.id";
        $results = DB::select($queryUser);
        $data = DB::select($query);
        return view('pages.dashboard.index', [
            'dataUsers' => $results,
            'data' => $data,
        ]);
    }
}
