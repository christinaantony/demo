import React from "react";
import { HStack } from "@/components/ui/hstack";
import { VStack } from "@/components/ui/vstack";
import { Box } from "@/components/ui/box";
import { Icon } from "@/components/ui/icon";
import { Text } from "@/components/ui/text";
import { ArrowDown } from "@/components/shared/custom-icons/arrow-down";
import { ArrowUp } from "@/components/shared/custom-icons/arrow-up";

interface IHourlyCard {
  icon: any;
  text: string;
  currentUpdate: string;
  lastUpdate: string;
  arrowDownIcon?: boolean;
  arrowUpIcon?: boolean;
}

const HourlyCard = ({
  icon,
  text,
  currentUpdate,
  lastUpdate,
  arrowDownIcon,
  arrowUpIcon,
}: IHourlyCard) => {
  return (
    <VStack
      space="sm"
      className="px-3 py-3 rounded-2xl bg-background-100 flex-1 items-left"
    >
      <Box className="h-8 w-8 bg-background-50 rounded-full items-center justify-center">
        <Icon as={icon} className="text-background-800" />
      </Box>
      <VStack className="flex-1" space="xs">
        <Text className="text-typography-900" size="lg">
          {text}
        </Text>
        <HStack className="justify-between items-center">
          <Text className="text-typography-900">{currentUpdate}</Text>
          <HStack className="items-center">
            {arrowDownIcon && <ArrowDown />}
            {arrowUpIcon && <ArrowUp />}
            <Text size="sm" className="text-typography-900">
              {lastUpdate}
            </Text>
          </HStack>
        </HStack>
      </VStack>
    </VStack>
  );
};

export default HourlyCard;
