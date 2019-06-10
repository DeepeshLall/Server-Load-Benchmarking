#!/bin/bash

Rscript --vanilla r_script.r user_time.csv "user_vs_total_latency" "../../graphs/generated_graphs/"

Rscript --vanilla r_script_2.r user_time_page.csv "user_vs_latency_wrt_pages" "../../graphs/generated_graphs/"