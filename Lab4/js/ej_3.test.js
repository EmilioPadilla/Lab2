var ar = [-1, 1, 2, 3, 4, 5, 0, 0, -2];
var ar2 = [0, 0, 0, 0, 0, 0, 0, 12, 13, 2, 13, 3, 4, 5, -2, -3, -4, -1];

const counter = require('./ej_3');

test('Test ar1 for 5 positives, 2 negatives and 2 neutrals', () => {
  expect(counter(ar)).toBe('5, 2, 2');
})

test('Test ar2 for 7 positives, 4 negatives and 7 neutrals', () => {
  expect(counter(ar2)).toBe('7, 4, 7');
})
