/*
*
* MAIN APP INIT
*
*/

// Handles all table input element data updates and deletions
Query.updateInputData();

// Handles all table select element data updates
Query.updateSelectData();

// Handles new row creations
Query.insertNewRow();

// Automatically change select element style class when changing values
Helper.changeSelectClass();