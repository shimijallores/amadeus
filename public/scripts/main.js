document.addEventListener('alpine:init', () => {
    Alpine.store('cart', {
        cart: [],

        init() {
            // Load cart from localStorage on initialization
            this.loadFromStorage();
        },

        loadFromStorage() {
            try {
                const savedCart = localStorage.getItem('merica_rocks_cart');
                if (savedCart) {
                    this.cart = JSON.parse(savedCart);
                    console.log('Cart loaded from localStorage:', this.cart);
                }
            } catch (error) {
                console.error('Error loading cart from localStorage:', error);
                this.cart = [];
            }
        },

        saveToStorage() {
            try {
                localStorage.setItem('merica_rocks_cart', JSON.stringify(this.cart));
                console.log('Cart saved to localStorage');
            } catch (error) {
                console.error('Error saving cart to localStorage:', error);
            }
        },

        addItem(product, quantity = 1) {
            const existingItem = this.cart.find(item => item.id === product.id);

            if (existingItem) {
                existingItem.quantity += quantity;
            } else {
                this.cart.push({
                    ...product,
                    quantity: quantity
                });
            }

            this.saveToStorage(); // Save to localStorage after adding
            console.log('Added to cart:', product, 'Quantity:', quantity);
            console.log('Cart now contains:', this.cart);
        },

        removeItem(productId) {
            this.cart = this.cart.filter(item => item.id !== productId);
            this.saveToStorage(); // Save to localStorage after removing
        },

        updateQuantity(productId, quantity) {
            const item = this.cart.find(item => item.id === productId);
            if (item) {
                if (quantity <= 0) {
                    this.removeItem(productId);
                } else {
                    item.quantity = quantity;
                    this.saveToStorage(); // Save to localStorage after updating
                }
            }
        },

        getItemCount() {
            return this.cart.reduce((total, item) => total + item.quantity, 0);
        },

        getTotalPrice() {
            return this.cart.reduce((total, item) => total + (item.price * item.quantity), 0);
        },

        clearCart() {
            this.cart = [];
            this.saveToStorage(); // Save to localStorage after clearing
        }
    });

    // Initialize cart from localStorage
    Alpine.store('cart').init();
})