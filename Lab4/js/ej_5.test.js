var number = 12345678
var number2 = 43872589273

const invertNumber = require('./ej_5');

test('Test "1234567890" for its inverse', () => {
  expect(invertNumber(number)).toBe('87654321');
});

test('Test "1234567890" for its inverse', () => {
  expect(invertNumber(number2)).toBe('37298527834');
});
