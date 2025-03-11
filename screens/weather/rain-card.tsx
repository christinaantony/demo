import React from "react";
import { Progress, ProgressFilledTrack } from "@/components/ui/progress";
import { HStack } from "@/components/ui/hstack";
import { Text } from "@/components/ui/text";
import { Box } from "@/components/ui/box";

interface IRainCard {
  time: number;
  value: number;
}

const RainCard = ({ time, value }: IRainCard) => {
  return (
    <HStack className="justify-between items-center" space="sm">
      <Box className="w-10">
        <Text className="text-typography-900" size="sm">
          {time}&nbsp;PM
        </Text>
      </Box>

      <Box className="flex-1">
        <Progress value={value} className="w-full h-6 bg-background-0">
          <ProgressFilledTrack className="h-6 bg-secondary-400" />
        </Progress>
      </Box>

      <Text className="text-typography-900" size="sm">
        {value}%
      </Text>
    </HStack>
  );
};

export default RainCard;
