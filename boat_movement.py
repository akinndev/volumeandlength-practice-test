def can_travel_to(game_matrix, from_row, from_column, to_row, to_column):
    # Check that:
    # 1- The given coordinates within the grid.
    # 2- Restrict the steps (two when moving top/down and one left/right).
    # 3- Check that The start and end coordinates are True, otherwise return False
    if (from_row < 0 or from_row >= len(game_matrix) or
        from_column < 0 or from_column >= len(game_matrix[0]) or
        to_row < 0 or to_row >= len(game_matrix) or
        to_column < 0 or to_column >= len(game_matrix[0]) or
        not game_matrix[from_row][from_column] or
        not game_matrix[to_row][to_column]):
        return False
    
    # Setup BFS
    # init first point is starting [from_row, from_column]
    queue = [(from_row, from_column)]
    
    # history checked point
    visited = set()
    visited.add((from_row, from_column))
    
    # process....
    while queue:
        current_row, current_col = queue.pop(0)
        
        # if current is dest point, finish...
        if current_row == to_row and current_col == to_column:
            return True
        
        # check next point
        for dr, dc in [(-1, 0), (1, 0), (0, -1), (0, 1)]:
            new_row, new_col = current_row + dr, current_col + dc
            if (0 <= new_row < len(game_matrix) and
                0 <= new_col < len(game_matrix[0]) and
                game_matrix[new_row][new_col] and
                (new_row, new_col) not in visited):
                visited.add((new_row, new_col))
                queue.append((new_row, new_col))
               
    # if not found
    return False

gameMatrix = [
    [False, True,  True,  False, False, False],
    [True,  True,  True,  False, False, False],
    [True,  True,  True,  True,  True,  True],
    [False, True,  True,  False, True,  True],
    [False, True,  True,  True,  False, True],
    [False, False, False, False, False, False],
]

print(can_travel_to(gameMatrix, 3, 2, 2, 2)) # True, Valid move
print(can_travel_to(gameMatrix, 3, 2, 3, 3)) # False, Can't travel through land
print(can_travel_to(gameMatrix, 3, 2, 6, 2)) # False, Out of bounds