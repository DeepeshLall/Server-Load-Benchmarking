#!/usr/bin/Rscript
args=commandArgs(trailingOnly=TRUE)
library("ggplot2")
t=read.csv(args[1])
print(t)
p<-ggplot(t)+geom_line(aes(x=user_number,y=avg_latency_time,color=url_number))+labs(x='user number',y='Average latency time',title='latency vs per user for differrent pages')+facet_grid(url_number~.)
ggsave(p,file = paste0(args[3], args[2], ".png"),device = "png")
