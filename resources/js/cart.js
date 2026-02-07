function getCart() {
    return JSON.parse(localStorage.getItem('volunteco-cart')) || [];
}

function saveCart(cart) {
    localStorage.setItem('volunteco-cart', JSON.stringify(cart));
    updateCartCount();
}

function addToCart(product, quantity = 1) {
    let cart = getCart();
    let existing = cart.find(item => item.id === product.id);
    const price = Number(product.price);

    if (existing) {
        existing.quantity += quantity;
    } else {
        cart.push({
            id: product.id,
            name: product.name,
            price: price,
            quantity: quantity
        });
    }

    saveCart(cart);
}

function getTotalQuantity() {
    return getCart().reduce((sum, item) => sum + item.quantity, 0);
}

function updateCartCount() {
    const count = document.getElementById('cart-count');
    if (count) {
        count.textContent = getTotalQuantity();
    }
}

function showCartMessage() {
    const msg = document.getElementById('cart-message');
    if (!msg) return;

    msg.classList.add('show');

    setTimeout(() => {
        msg.classList.remove('show');
    }, 2000);
}

function formatPrice(price) {
    return Number(price).toLocaleString('es-ES', {
        minimumFractionDigits: 2,
        maximumFractionDigits: 2,
        useGrouping: true
    });
}


function renderCartTable() {
    const tbody = document.getElementById('cart-body');
    const totalTd = document.getElementById('cart-total');
    if (!tbody || !totalTd) return;

    const cart = getCart();
    tbody.innerHTML = '';

    let total = 0;

    cart.forEach(item => {
        const subtotal = Number(item.price) * Number(item.quantity);
        total += subtotal;

        const tr = document.createElement('tr');
        tr.classList.add('align-middle');

        tr.innerHTML = `
            <td>
                <div class="d-flex gap-3 align-items-center">
                    <img src="${item.image ? '/storage/' + item.image : '/storage/thumbnail-proyecto.jpg'}"
                         width="100" height="100" class="object-fit-cover" alt="${item.name}">
                    <div>${item.name}</div>
                </div>
            </td>
            <td>$ ${formatPrice(item.price)}</td>
            <td>
                <input type="number" min="1" value="${item.quantity}"
                       data-id="${item.id}" class="cart-quantity form-control" style="width:80px;">
            </td>
            <td>$ ${formatPrice(subtotal)}</td>
            <td>
                <button data-id="${item.id}" class="btn btn-sm btn-danger remove-item">✕</button>
            </td>
        `;

        tbody.appendChild(tr);
    });

    totalTd.textContent = `$ ${formatPrice(total)}`;
}

// Todos los botones con la clase add-to-cart agregan el producto definido en el data-product al carrito
document.addEventListener('click', e => {
    if (e.target.classList.contains('add-to-cart')) {
        const button = e.target;
        const data = button.dataset.product;
        if (!data) return;

        const product = JSON.parse(data);

        const quantityInput = document.getElementById('product-quantity');

        const quantity = Math.max(1, parseInt(quantityInput.value) || 1);

        addToCart(product, quantity);

        const cartUrl = button.dataset.cartUrl || '/carrito';
        window.location.href = cartUrl;

        //showCartMessage();
    }
});

document.addEventListener('input', e => {
    if (e.target.classList.contains('cart-quantity')) {
        const id = parseInt(e.target.dataset.id);
        const quantity = Math.max(1, parseInt(e.target.value) || 1);

        let cart = getCart();
        const item = cart.find(p => p.id === id);
        if (item) {
            item.quantity = quantity;
            saveCart(cart);
            renderCartTable();
        }
    }
});

document.addEventListener('click', e => {
    if (e.target.classList.contains('remove-item')) {
        const id = parseInt(e.target.dataset.id);
        let cart = getCart().filter(p => p.id !== id);
        saveCart(cart);
        renderCartTable();
    }
});

document.addEventListener('DOMContentLoaded', () => {
    updateCartCount();
    renderCartTable();
});
