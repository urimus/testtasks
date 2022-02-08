const array = [1, 2, 500, 1000, 10000, 5, 0]; // Множество (массив, где порядок не важен) целых чисел (от 1 до 1,000). Количество чисел - до 200.
let textArray = array.join(","); // сериализация
console.log(textArray);
let array2 = textArray.split(","); // десериализация