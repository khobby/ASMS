from html.parser import HTMLParser
from pathlib import Path

class AccidentParser(HTMLParser):
    def __init__(self):
        super().__init__()
        self.in_td = False
        self.current_cell = ''
        self.cells = []
        self.rows = []
        self.in_row = False
        self.collected = []
        self.row_depth = 0

    def handle_starttag(self, tag, attrs):
        if tag == 'tr':
            self.in_row = True
            self.row_depth += 1
            self.current_cell = ''
            self.cells = []
        elif self.in_row and tag == 'td':
            self.in_td = True
            self.current_cell = ''

    def handle_endtag(self, tag):
        if tag == 'td' and self.in_td:
            self.in_td = False
            self.cells.append(self.current_cell.strip())
        elif tag == 'tr' and self.in_row:
            if self.cells:
                self.rows.append(self.cells.copy())
            self.in_row = False
            self.cells = []

    def handle_data(self, data):
        if self.in_td:
            self.current_cell += data

html = Path('ghana.html').read_text(encoding='utf-8')
parser = AccidentParser()
parser.feed(html)
print('row count', len(parser.rows))
for i, row in enumerate(parser.rows[:15]):
    print(i, row)
