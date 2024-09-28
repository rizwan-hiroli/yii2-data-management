<?php

namespace app\commands;

use yii\console\Controller;
use yii\console\ExitCode;
use Yii;
use app\models\Products; // Assuming Product model exists

class ProductExportController extends Controller
{
    // This action will export products to a CSV file
    public function actionExport()
    {
        $products = Products::find()->all(); // Fetch all products from the database
        
        // Define the file path to store the CSV
        $filePath = Yii::getAlias('@app/runtime/exports/products_' . date('Y-m-d_H-i-s') . '.csv');
        
        // Open the file for writing
        $file = fopen($filePath, 'w');

        // Write the CSV headers
        fputcsv($file, ['ID', 'Name', 'Price', 'Description', 'Created At']);

        // Write product data to the CSV
        foreach ($products as $product) {
            fputcsv($file, [
                $product->id,
                $product->name,
                $product->price,
                $product->description,
                $product->created_at,
            ]);
        }

        // Close the file
        fclose($file);

        // Output the result to the console
        $this->stdout("Products exported successfully to: $filePath\n");

        return ExitCode::OK;
    }
}
