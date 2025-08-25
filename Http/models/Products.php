<?php

namespace Http\models;

use Core\App;
use Core\Database;
use Core\Session;

class Products
{
    protected $db;

    public function __construct()
    {
        $this->db = App::resolve(Database::class);
    }

    public function store(array $attributes): void
    {
        $imagePath = $this->upload_image($attributes['image']);

        $this->db->query('INSERT INTO products (name, size, description, category, price, quantity, image_url)
            VALUES (:name, :size, :description, :category, :price, :quantity, :image_url)', [
            'name' => $attributes['name'],
            'size' => $attributes['size'],
            'description' => $attributes['description'],
            'category' => $attributes['category'],
            'price' => $attributes['price'],
            'quantity' => $attributes['quantity'],
            'image_url' => $imagePath,
        ]);

        Session::flash('success', 'Product added successfully!');
    }

    public function update(array $attributes): void
    {
        $imagePath = $this->handle_image_update($attributes['id'], $attributes['image'] ?? null);

        $query = 'UPDATE products SET name = :name, size = :size, description = :description, 
                  category = :category, price = :price, quantity = :quantity';

        $params = [
            'name' => $attributes['name'],
            'size' => $attributes['size'],
            'description' => $attributes['description'],
            'category' => $attributes['category'],
            'price' => $attributes['price'],
            'quantity' => $attributes['quantity'],
            'id' => $attributes['id']
        ];

        if ($imagePath) {
            $query .= ', image_url = :image_url';
            $params['image_url'] = $imagePath;
        }

        $query .= ' WHERE id = :id';

        $this->db->query($query, $params);

        Session::flash('success', 'Product updated successfully!');
    }

    public function destroy(array $attributes): void
    {
        $this->delete_image($attributes['id']);

        $this->db->query('DELETE FROM products WHERE id = :id', [
            'id' => $attributes['id']
        ]);

        Session::flash('success', 'Product deleted successfully!');
    }

    /**
     * Handle image update for a product - uploads new image and deletes old one if necessary
     */
    private function handle_image_update(int $productId, ?array $image): ?string
    {
        if (!$image || $image['error'] !== UPLOAD_ERR_OK) {
            return null;
        }

        $oldImageUrl = $this->get_image_url($productId);
        $newImagePath = $this->upload_image($image);

        if ($oldImageUrl) {
            $this->unlink_image($oldImageUrl);
        }

        return $newImagePath;
    }

    /**
     * Delete the image file associated with a product
     */
    private function delete_image(int $productId): void
    {
        $imageUrl = $this->get_image_url($productId);

        if ($imageUrl) {
            $this->unlink_image($imageUrl);
        }
    }

    /**
     * Get the image URL for a specific product
     */
    private function get_image_url(int $productId): ?string
    {
        $product = $this->db->query('SELECT image_url FROM products WHERE id = :id', [
            'id' => $productId
        ])->find();

        return $product['image_url'] ?? null;
    }

    /**
     * Delete an image file from the filesystem
     */
    private function unlink_image(string $imageUrl): void
    {
        $imagePath = base_path('public' . $imageUrl);

        if (file_exists($imagePath)) {
            unlink($imagePath);
        }
    }

    /**
     * Upload an image file and return the relative path
     */
    private function upload_image(array $file): string
    {
        $uploadDir = base_path('public/uploads/');

        $fileExtension = pathinfo($file['name'], PATHINFO_EXTENSION);
        $fileName = uniqid('product_', true) . '.' . $fileExtension;
        $filePath = $uploadDir . $fileName;

        if (!move_uploaded_file($file['tmp_name'], $filePath)) {
            throw new \Exception('Failed to upload image');
        }

        return '/uploads/' . $fileName;
    }
}