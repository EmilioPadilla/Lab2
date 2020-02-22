var pass1 = "abcabc"
var pass2 = "abcd"

const generateN = require('./ej_6');

test('Test k=3 n=6', () => {
  expect(generateN(6,'abc')).toBe(pass1);
});

test('Test k=4 n=4', () => {
  expect(generateN(4,'abcd')).toBe(pass2);
});
