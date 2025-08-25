<?php

namespace Http\forms;

use Core\Validator;

class ProductForm extends Form
{
    public function __construct($attributes)
    {
        $this->attributes = $attributes;

        if (!Validator::string($this->attributes['name'], 1, 50)) {
            $this->errors['name'] = "Enter a valid product name (1-50 characters)";
        }

        if (!Validator::string($this->attributes['size'], 1, 10)) {
            $this->errors['size'] = "Enter a valid product size (1-10 characters)";
        }

        if (!Validator::string($this->attributes['description'], 5, 1000)) {
            $this->errors['description'] = "Enter a valid product description (5-1000 characters)";
        }

        if (!Validator::string($this->attributes['category'], 1, 50)) {
            $this->errors['category'] = "Enter a valid category (1-50 characters)";
        }

        if (!Validator::number($this->attributes['price'], 0)) {
            $this->errors['price'] = "Enter a valid price";
        }

        if (!Validator::number($this->attributes['quantity'], 0)) {
            $this->errors['quantity'] = "Enter a valid quantity";
        }

        if (! $this->attributes['method'] == 'PATCH' ?? false) {
            // Make image required
            if (!$this->attributes['image'] || $this->attributes['image']['size'] === 0) {
                $this->errors['image'] = "Product image is required";
            } elseif (!Validator::image($this->attributes['image'])) {
                $this->errors['image'] = "Please upload a valid image file (JPEG, PNG, GIF, WebP, AVIF) under 2MB";
            }
        }

    }
}
