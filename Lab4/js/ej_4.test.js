var matrix1 = [[1,2,4,5,7], [1,2,4,3,5], [8,9,7,6,5], [2,5,6,8,0]]
var matrix2 = [[10,9,8,7,6], [6,5,4,3,2], [1,3,5,7,9], [2,4,6,8,10]]

const averageMatrix = require('./ej_4');

describe('arrayContaining', () => {
  const expected1 = [3.8, 3, 7, 4.2]
  const expected2 = [8, 4, 6, 5]
  it('Test matrix1', () => {
    expect(averageMatrix(matrix1)).toEqual(expect.arrayContaining(expected1));
  })

  it('Test matrix2', () => {
    expect(averageMatrix(matrix2)).toEqual(expect.arrayContaining(expected2));
  })

})
