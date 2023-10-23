<?php
//call main fpdf file
require('fpdf.php');

//create new class extending fpdf class
class PDF_MC_Table extends FPDF
{

    // variable to store widths and aligns of cells, and line height
    var $widths;
    var $aligns;
    var $lineHeight;

    //Set the array of column widths
    function SetWidths($w)
    {
        $this->widths = $w;
    }

    //Set the array of column alignments
    function SetAligns($a)
    {
        $this->aligns = $a;
    }

    //Set line height
    function SetLineHeight($h)
    {
        $this->lineHeight = $h;
    }

    //Calculate the height of the row
    function Row($data)
    {
        // number of line
        $nb = 0;

        // loop each data to find out greatest line number in a row.
        for ($i = 0; $i < count($data); $i++) {
            // NbLines will calculate how many lines needed to display text wrapped in specified width.
            // then max function will compare the result with current $nb. Returning the greatest one. And reassign the $nb.
            $nb = max($nb, $this->NbLines($this->widths[$i], $data[$i]));
        }

        //multiply number of line with line height. This will be the height of current row
        $h = $this->lineHeight * $nb;

        //Issue a page break first if needed
        $this->CheckPageBreak($h);

        //Draw the cells of current row
        for ($i = 0; $i < count($data); $i++) {
            // width of the current col
            $w = $this->widths[$i];
            // alignment of the current col. if unset, make it left.
            $a = isset($this->aligns[$i]) ? $this->aligns[$i] : 'L';
            //Save the current position
            $x = $this->GetX();
            $y = $this->GetY();
            //Draw the border
            $this->Rect($x, $y, $w, $h);
            //Print the text
            $this->MultiCell($w, 5, $data[$i], 0, $a);
            //Put the position to the right of the cell
            $this->SetXY($x + $w, $y);
        }
        //Go to the next line
        $this->Ln($h);
    }

    function CheckPageBreak($h)
    {
        //If the height h would cause an overflow, add a new page immediately
        if ($this->GetY() + $h > $this->PageBreakTrigger)
            $this->AddPage($this->CurOrientation);
    }

    function NbLines($w, $txt)
    {
        //calculate the number of lines a MultiCell of width w will take
        $cw = &$this->CurrentFont['cw'];
        if ($w == 0)
            $w = $this->w - $this->rMargin - $this->x;
        $wmax = ($w - 2 * $this->cMargin) * 1000 / $this->FontSize;
        $s = str_replace("\r", '', $txt);
        $nb = strlen($s);
        if ($nb > 0 and $s[$nb - 1] == "\n")
            $nb--;
        $sep = -1;
        $i = 0;
        $j = 0;
        $l = 0;
        $nl = 1;
        while ($i < $nb) {
            $c = $s[$i];
            if ($c == "\n") {
                $i++;
                $sep = -1;
                $j = $i;
                $l = 0;
                $nl++;
                continue;
            }
            if ($c == ' ')
                $sep = $i;
            $l += $cw[$c];
            if ($l > $wmax) {
                if ($sep == -1) {
                    if ($i == $j)
                        $i++;
                } else
                    $i = $sep + 1;
                $sep = -1;
                $j = $i;
                $l = 0;
                $nl++;
            } else
                $i++;
        }
        return $nl;
    }
    function CellFit($w, $h = 0, $txt = '', $border = 0, $ln = 0, $align = '', $fill = false, $link = '', $scale = false, $force = true)
    {
        //Get string width
        $str_width = $this->GetStringWidth($txt);

        //Calculate ratio to fit cell
        if ($w == 0)
            $w = $this->w - $this->rMargin - $this->x;
        $ratio = ($w - $this->cMargin * 2) / $str_width;

        $fit = ($ratio < 1 || ($ratio > 1 && $force));
        if ($fit) {
            if ($scale) {
                //Calculate horizontal scaling
                $horiz_scale = $ratio * 100.0;
                //Set horizontal scaling
                $this->_out(sprintf('BT %.2F Tz ET', $horiz_scale));
            } else {
                //Calculate character spacing in points
                $char_space = ($w - $this->cMargin * 2 - $str_width) / max(strlen($txt) - 1, 1) * $this->k;
                //Set character spacing
                $this->_out(sprintf('BT %.2F Tc ET', $char_space));
            }
            //Override user alignment (since text will fill up cell)
            $align = '';
        }

        //Pass on to Cell method
        $this->Cell($w, $h, $txt, $border, $ln, $align, $fill, $link);

        //Reset character spacing/horizontal scaling
        if ($fit)
            $this->_out('BT ' . ($scale ? '100 Tz' : '0 Tc') . ' ET');
    }

    //Cell with horizontal scaling only if necessary
    function CellFitScale($w, $h = 0, $txt = '', $border = 0, $ln = 0, $align = '', $fill = false, $link = '')
    {
        $this->CellFit($w, $h, $txt, $border, $ln, $align, $fill, $link, true, false);
    }

    //Cell with horizontal scaling always
    function CellFitScaleForce($w, $h = 0, $txt = '', $border = 0, $ln = 0, $align = '', $fill = false, $link = '')
    {
        $this->CellFit($w, $h, $txt, $border, $ln, $align, $fill, $link, true, true);
    }

    //Cell with character spacing only if necessary
    function CellFitSpace($w, $h = 0, $txt = '', $border = 0, $ln = 0, $align = '', $fill = false, $link = '')
    {
        $this->CellFit($w, $h, $txt, $border, $ln, $align, $fill, $link, false, false);
    }

    //Cell with character spacing always
    function CellFitSpaceForce($w, $h = 0, $txt = '', $border = 0, $ln = 0, $align = '', $fill = false, $link = '')
    {
        //Same as calling CellFit directly
        $this->CellFit($w, $h, $txt, $border, $ln, $align, $fill, $link, false, true);
    }
    function centerText($text, $width, $height, $font)
    {
        // Get the width and height of the text
        $textWidth = $this->GetStringWidth($text);
        $textHeight = $this->FontSize;

        // Calculate the X and Y coordinates to center the text
        $x = ($width - $textWidth) / 2;
        $y = ($height - $textHeight) / 2;

        // Set the font and position for the text
        $this->SetFont($font);
        $this->SetXY($x, $y);
        $this->Cell(0, 0, $text, 0, 0, 'C');
    }

    function morepagestable($datas, $lineheight = 4, $valign = 'M')
    {
        // some things to set and 'remember'
        $l = $this->lMargin;
        $startheight = $h = $this->GetY();
        $startpage = $currpage = $maxpage = $this->page;
        $lineheights = array(); // Array to store custom line heights

        // calculate the whole width
        $fullwidth = 0;
        foreach ($this->tablewidths as $width) {
            $fullwidth += $width;
        }

        // Now let's start to write the table
        foreach ($datas as $row => $data) {
            $this->page = $currpage;
            // write the horizontal borders
            $this->Line($l, $h, $fullwidth + $l, $h);
            // write the content and remember the height of the highest col
            foreach ($data as $col => $cell) {
                $this->page = $currpage;
                $this->SetXY($l, $h);

                // Get the text, alignment, and line height from the cell array
                $txt = $cell["text"];
                $align = isset($cell["align"]) ? $cell["align"] : 'C'; // Center alignment if not specified
                $customLineHeight = isset($lineheights[$row][$col]) ? $lineheights[$row][$col] : $lineheight;

                // Calculate the X and Y coordinates to center the text only if alignment is 'C'
                if ($align == 'C') {
                    $textWidth = $this->GetStringWidth($txt);
                    $textHeight = $customLineHeight;
                    $x = $l + ($this->tablewidths[$col] - $textWidth) / 2;
                    $y = $h + ($textHeight - $this->FontSize) / 2;
                    $this->SetXY($x, $y);
                }

                // Use MultiCell for all cases
                $this->MultiCell($this->tablewidths[$col], $customLineHeight, $txt, 0, $align);

                $l += $this->tablewidths[$col];

                if (!isset($tmpheight[$row . '-' . $this->page]))
                    $tmpheight[$row . '-' . $this->page] = 0;
                if ($tmpheight[$row . '-' . $this->page] < $this->GetY()) {
                    $tmpheight[$row . '-' . $this->page] = $this->GetY();
                }
                if ($this->page > $maxpage)
                    $maxpage = $this->page;
            }

            // get the height we were in the last used page
            $h = $tmpheight[$row . '-' . $maxpage];
            // set the "pointer" to the left margin
            $l = $this->lMargin;
            // set the $currpage to the last page
            $currpage = $maxpage;
        }
        // draw the borders
        // we start adding a horizontal line on the last page
        $this->page = $maxpage;
        $this->Line($l, $h, $fullwidth + $l, $h);
        // now we start at the top of the document and walk down
        for ($i = $startpage; $i <= $maxpage; $i++) {
            $this->page = $i;
            $l = $this->lMargin;
            $t = ($i == $startpage) ? $startheight : $this->tMargin;
            $lh = ($i == $maxpage)   ? $h : $this->h - $this->bMargin;
            $this->Line($l, $t, $l, $lh);
            foreach ($this->tablewidths as $width) {
                $l += $width;
                $this->Line($l, $t, $l, $lh);
            }
        }
        // set it to the last page, if not it'll cause some problems
        $this->page = $maxpage;
    }
}

// Custom function to set line height
