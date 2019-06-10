#!/usr/bin/Rscript
args=commandArgs(trailingOnly=TRUE)
library(ggplot2)
t=read.csv(args[1])
print(t)
p<-ggplot(t)+geom_line(aes(x=no_of_user,y=latency_time,color=url_no))+labs(x='number of users',y='latency time',title='latency vs number of users')+facet_grid(url_no~.)
ggsave(p,file = paste0(args[3], args[2], ".png"),device = "png")