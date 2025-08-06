const wrapper = document.querySelector(".sliderWrapper");
const menuItems = document.querySelectorAll(".menuItem");

const products = [
  {
    id: 1,
    title: "Cap",
    price: 4.99,
    colors: [
      {
        code: "black",
        img: "./img/Product/air.png",
      },
      {
        code: "white",
        img: "./img/Product/air2.png",
      },
    ],
  },
  {
    id: 2,
    title: "Sweater",
    price: 19.99,
    colors: [
      {
        code: "black",
        img: "./img/Product/jordan.png",
      },
      {
        code: "white",
        img: "./img/Product/jordan2.png",
      },
    ],
  },
  {
    id: 3,
    title: "T-shirt",
    price: 4.99,
    colors: [
      {
        code: "black",
        img: "./img/Product/blazer.png",
      },
      {
        code: "white",
        img: "./img/Product/blazer2.png",
      },
    ],
  },
  {
    id: 4,
    title: "Pants",
    price: 9.99,
    colors: [
      {
        code: "black",
        img: "./img/Product/crater.png",
      },
      {
        code: "white",
        img: "./img/Product/crater2.png",
      },
    ],
  },
  {
    id: 5,
    title: "Shoes",
    price: 19.99,
    colors: [
      {
        code: "black",
        img: "./img/Product/hippie.png",
      },
      {
        code: "blue",
        img: "./img/Product/hippie2.png",
      },
    ],
  },
];

let choosenProduct = products[0];

const currentProductImg = document.querySelector(".productImg");
const currentProductTitle = document.querySelector(".productTitle");
const currentProductPrice = document.querySelector(".productPrice");
const currentProductColors = document.querySelectorAll(".color");
const currentProductSizes = document.querySelectorAll(".size");

menuItems.forEach((item, index) => {
  item.addEventListener("click", () => {
    //change the current slide
    wrapper.style.transform = `translateX(${-100 * index}vw)`;

    //change the choosen product
    choosenProduct = products[index];

    //change texts of currentProduct
    currentProductTitle.textContent = choosenProduct.title;
    currentProductPrice.textContent = "RM" + choosenProduct.price;
    currentProductImg.src = choosenProduct.colors[0].img;

    //assing new colors
    currentProductColors.forEach((color, index) => {
      color.style.backgroundColor = choosenProduct.colors[index].code;
    });
  });
});

currentProductColors.forEach((color, index) => {
  color.addEventListener("click", () => {
    currentProductImg.src = choosenProduct.colors[index].img;
  });
});

currentProductSizes.forEach((size, index) => {
  size.addEventListener("click", () => {
    currentProductSizes.forEach((size) => {
      size.style.backgroundColor = "white";
      size.style.color = "black";
    });
    size.style.backgroundColor = "black";
    size.style.color = "white";
  });
});


const productButton = document.querySelector(".productButton");
const payment = document.querySelector(".payment");
const close = document.querySelector(".close");

productButton.addEventListener("click", () => {
  payment.style.display = "flex";
});

close.addEventListener("click", () => {
  payment.style.display = "none";
});
